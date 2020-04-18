<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Quiz;
use App\Tag;
use App\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class QuizController extends Controller
{

    public function __construct()
    {
        View::share('sharedData', [
            'popularQuizzes' => Quiz::popular(7),
            'popularTags' => Tag::popular(10),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag = Tag::where('name', request('tag'))->first();
        return view('quizIndex', [
            'latestQuizzes' => Quiz::latest(7, $tag),
            'tag' => $tag
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quizCreation');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $request->validated();
        $quiz = Quiz::create(
            [
                'user_id' => auth()->user()->id,
                'title' => $request->title,
                'short_description' => $request->short_description,
                'long_description' => $request->additional_information,
                'difficulty_level' => intval($request->difficulty_level),
            ]
        );

        return redirect()->route('quizEdit', ["id" => $quiz->id]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $quiz = Quiz::find(request("id"));
        return view('quizShow', array('quiz' => $quiz));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::find($id);

        if ($quiz != null && auth()->user()->id == $quiz->user_id) {
            return view('quizCreation', ["quiz" => $quiz]);
        }
        return redirect()->route('quizCreate');
    }

    public function destroy($id) {
        $quiz = Quiz::find($id);
        if ($quiz != null && auth()->user()->id == $quiz->user_id) {
            $quiz->delete();
        }
        return redirect()->route('home');
    }

    public function update(Request $request, $id) {
        $quiz = Quiz::find($id);

        if ($quiz != null && auth()->user()->id == $quiz->user_id) {
            $quiz->update([
                    'title' => $request->title,
                    'short_description' => $request->short_description,
                    'long_description' => $request->additional_information,
                    'difficulty_level' => intval($request->difficulty_level),
                ]
            );
        }

        return redirect()->route('quizEdit', ["id" => $id]);
    }

    public function bind(Request $request) {
        $userId = auth()->user()->id;
        $quiz = Quiz::find(request("quizId"));
        $question = Question::find(request("questionId"));
        if ($quiz->user_id == $userId && $question->user_id == $userId) {
            $question->quizzes()->attach($quiz);
        }
    }

    public function unbind(Request $request) {
        $userId = auth()->user()->id;
        $quiz = Quiz::find(request("quizId"));
        $question = Question::find(request("questionId"));
        if ($quiz->user_id == $userId && $question->user_id == $userId) {
            $question->quizzes()->detach($quiz);
        }
    }

    public function saveScore(Request $request) {
        $score = 0;
        $quiz = Quiz::find($request->quizId);

        foreach($request->guesses as $question) {

            $type = Question::find($question["id"])->type;
            $questionScore = 1;

            foreach($question["guesses"] as $answer) {

                $answerInstance = Answer::find($answer["id"]);

                if ($type != 3 && $answerInstance->is_right_answer != $answer["selected"]) {
                    $questionScore = 0;
                }
                else if ($type == 3 && $answerInstance->text == $answer["user_guess"]) {
                    $questionScore = 0;
                }
            }

            $score += $questionScore;
        }
        $correctRatio = round($score / $quiz->questions->count(), 2);

        if (auth()->user()->scores()->where('quiz_id', $quiz->id)->exists()) {
            $quiz->scores()->updateExistingPivot(auth()->user()->id, [
                'correct_ratio' => $correctRatio,
                'time_passed' => $request->timePassed
            ]);
        }
        else {
            $quiz->scores()->attach(auth()->user()->id, [
                'correct_ratio' => $correctRatio,
                'time_passed' => $request->timePassed
            ]);
        }
    }

    public function bindTag(Request $request) {
        $quiz = App\Quiz::find($request->quiz_id);
        $quiz->tags()->attach(App\Tag::find($request->tag_id));
    }
}
