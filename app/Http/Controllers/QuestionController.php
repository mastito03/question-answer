<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Question;
use App\Tag;

use Auth;

class QuestionController extends Controller
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
        $questions = Question::latest()->with(['answersCount','user','tags'])->paginate(15);
        return view('questions.index')->with('questions',$questions);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function unanswered()
    {
        $questions = Question::latest()->has('answers','=','0')->with(['answersCount','user','tags'])->paginate(15);
        return view('questions.index')->with('questions',$questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $tag = Tag::lists('name','id');
        return view('questions.create')->with('tags',$tag);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $question = Auth::user()->questions()->create($request->all());

        $this->updateTags($question, $request->input('tags_list'));

        return redirect()->route('questions.show',$question->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Question $question, Request $request)
    {
        $sort = $request->input('sort') ?: 'votes';
        if($sort==='newest'){
            $answers = $question->answers()->orderBy('created_at','desc')->with(['user','comments'])->paginate();
        }elseif($sort==='active'){
            $answers = $question->answers()->orderBy('updated_at','desc')->with(['user','comments'])->paginate();
        }else{
            $answers = $question->answers()->orderBy('votes','desc')->orderBy('updated_at','desc')->with(['user','comments'])->paginate();
        }

        return view('questions.show')->with('question', $question)->with('answers', $answers)->with('sort', $sort);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Question $question)
    {
        $tag = Tag::lists('name','id');

        return view('questions.edit')->with('question',$question)->with('tags',$tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Question $question, Request $request)
    {
        $question->update($request->all());

        $this->updateTags($question, $request->input('tags_list'));

        return redirect()->route('questions.show',$question->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Question $question)
    {
        //
    }

    public function upvote(Question $question)
    {
        $question->votes += 1;
        $question->save();
        return redirect()->route('questions.show',$question->id);
    }

    public function downvote(Question $question)
    {
        $question->votes -= 1;
        $question->save();
        return redirect()->route('questions.show',$question->id);
    }

    public function favorites(Question $question)
    {
        if($question->isFavorited( auth()->user() )){
            $question->favorites()->attach(auth()->user());
        }else{
            $question->favorites()->detach(auth()->user());
        }
        return redirect()->route('questions.show',$question->id);
    }

    private function updateTags($question, $tags_list)
    {
        $question->tags()->sync( $tags_list ?: []);
    }
}
