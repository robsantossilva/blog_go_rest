<?php

namespace App\Http\Controllers;

use Core\Infrastructure\Blog\Repository\CommentRepository;
use Core\Infrastructure\Blog\Repository\PostRepository;
use Core\Usecase\Blog\CreatePost\CreatePostUsecase;
use Core\Usecase\Blog\CreatePost\InputCreatePostDto;
use Core\Usecase\Blog\ListComment\InputListCommentDto;
use Core\Usecase\Blog\ListComment\ListCommentUsecase;
use Illuminate\Http\Request;

class PostController extends Controller
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
    public function create($userId)
    {
        return view('post.create', compact('userId'));
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
            'user_id' => 'required',
            'title' => 'required|max:100',
            'body' => 'required|max:499'
        ]);

        $repository = new PostRepository();
        $usecase = new CreatePostUsecase($repository);
        $usecase->execute(new InputCreatePostDto(
            user_id: $request->get('user_id'),
            title: $request->get('title'),
            body: $request->get('body'),
        ));

        return redirect("/user/{$request->get('user_id')}/post");
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

    /**
     * Display the specified resource.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function showComment($postId)
    {
        $page = 1;
        $repository = new CommentRepository();
        $usecase = new ListCommentUsecase($repository);

        $comments = $usecase->execute(new InputListCommentDto(
            page: $page,
            post_id: $postId
        ));

        return view('post.comment_list', compact('comments', 'postId'));
    }
}
