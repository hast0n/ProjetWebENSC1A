<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/home');

// global route group adding local handling
//Route::group([
//    'prefix' => '{lang}',
//    'where' => ['locale' => '[a-zA-Z]{2}'],
//    ], function () {

    Auth::routes(['verify' => false]);

    Route::get('home', 'HomeController@index')->name('home');
    Route::get('about', function () {
        return view('about');
    })->name('about');

    // route group handling admin user routes


    Route::group(['middleware'=>'admin'], function () {


        Route::post('/quiz/edit/addQuestion', 'QuizController@bind')->name('bindQuestion');
        Route::post('/quiz/edit/removeQuestion', 'QuizController@unbind')->name('unbindQuestion');

        Route::post('/quiz/{id}/destroy', 'QuizController@destroy')->name('quizDestroy');
        Route::post('/quiz/{id}', 'QuizController@update')->name('quizUpdate');
        Route::post('/quiz', 'QuizController@store')->name('quizStore');

        Route::post('/question/destroy', 'QuestionController@destroy')->name('destroyQuestion');
        Route::post('/question', 'QuestionController@store')->name('questionStore');
        Route::get('/questions/get', 'QuestionController@get')->name('getQuestions');
        Route::get('/questions/{id}/answers', 'QuestionController@answers')->name('getAnswers');

        Route::get('/quiz/create', 'QuizController@create')->name('quizCreate');
        Route::get('/quiz/{id}/edit', 'QuizController@edit')->name('quizEdit');

    });

    Route::post('/quiz/saveScore', 'QuizController@saveScore')
        ->name('saveScore')
        ->middleware('auth');

    Route::get('/questions/{id}/untaggedAnswers', 'QuestionController@getUntaggedAnswers')
        ->name('getUntaggedAnswers')
        ->middleware('auth');

    Route::get('/profile', 'ProfileController@show')->name('profileShow')->middleware('auth');
    Route::post('/profile/switch', 'ProfileController@switch')->name('switchUserType')->middleware('auth');

    Route::get('/quiz', 'QuizController@index')->name('quiz');
    Route::get('/quiz/{id}', 'QuizController@show')->name('quizDetail')->middleware('auth');


    Route::fallback('HomeController@notFound');
//});
