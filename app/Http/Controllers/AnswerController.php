<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Question;
use App\Answer;

use Auth;
use DB;

class AnswerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','unanswered','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Question $question, Request $request)
    {
        DB::beginTransaction();

            $answer = new Answer($request->all());

            $answer->user()->associate(Auth::user());

            $answer->question()->associate($question);

            $answer->save();

        DB::commit();

        return redirect()->route('questions.show',$question->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Question $question, Answer $answer)
    {
        return view('questions.answers.edit')->with('question',$question)->with('answer',$answer);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Question $question, Answer $answer, Request $request)
    {
        $answer->update($request->all());

        return redirect()->route('questions.show',$question->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


    public function upvote(Question $question, Answer $answer)
    {
        $answer->votes += 1;
        $answer->save();
        return redirect()->route('questions.show',$question->id);
    }

    public function downvote(Question $question, Answer $answer)
    {
        $answer->votes -= 1;
        $answer->save();
        return redirect()->route('questions.show',$question->id);
    }

    public function accept(Question $question, Answer $answer)
    {
        if($question->user === Auth::user()){
            $answer->accepted = !$answer->accepted;
        }
    }
}
