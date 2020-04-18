<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\User;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function get() {
        return User::find(auth()->user()->id)->questions;
    }

    public function answers($id) {
        $question = Question::find($id);
        if (auth()->user()->id == $question->user_id) {
            return Answer::where('question_id', $id)->get()->all();
        }
        else {
            return [];
        }
    }

    /**
     * @param $id
     * @return
     */
    public function getUntaggedAnswers($id) {
        return Question::find($id)->untaggedAnswers();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $question = Question::create([
                'user_id' => auth()->user()->id,
                'text' => $data["statement"],
                'type' => intval($data["answersType"]),
        ]);

        foreach ($data["answers"] as $answer) {
            Answer::create([
                'question_id' => $question->id,
                'text' => $answer["text"],
                'is_right_answer' => intval($answer["status"])
            ]);
        }

        return $question;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request)
    {
        $userId = auth()->user()->id;
        $question = Question::find($request->id);
        if ($userId == $question->user_id) {
            $question->delete();
        }
    }


}
