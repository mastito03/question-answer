<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Question;
use App\Answer;
use App\Comment;

use Auth;

class AnswerCommentController extends Controller
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
    public function create(Question $question, Answer $answer)
    {
        return view('comments.create')
        ->with('title',$question->title)
        ->with('content',$answer->parsed_content)
        ->with('route',['questions.answers.comments.store',$question->id,$answer->id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Question $question, Answer $answer, Request $request)
    {
        $comment = Auth::user()->comments()->create($request->all());

        $answer->comments()->save($comment);

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
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
}
