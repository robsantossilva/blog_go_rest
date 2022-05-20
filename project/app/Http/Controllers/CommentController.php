<?php

namespace App\Http\Controllers;

use Core\Infrastructure\Blog\Repository\CommentRepository;
use Core\Usecase\Blog\CreateComment\CreateCommentUsecase;
use Core\Usecase\Blog\CreateComment\InputCreateCommentDto;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($postId)
    {
        return view('comment.create', compact('postId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required',
            'name' => 'required|max:100',
            'email' => 'email',
            'body' => 'required|max:255'
        ]);

        $repository = new CommentRepository();
        $usecase = new CreateCommentUsecase($repository);
        $usecase->execute(new InputCreateCommentDto(
            post_id: $request->get('post_id'),
            name: $request->get('name'),
            email: $request->get('email'),
            body: $request->get('body'),
        ));

        return redirect("/post/{$request->get('post_id')}/comment");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
