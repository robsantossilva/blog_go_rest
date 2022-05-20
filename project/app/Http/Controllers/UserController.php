<?php

namespace App\Http\Controllers;

use Core\Infrastructure\Blog\Repository\PostRepository;
use Core\Infrastructure\User\Repository\UserRepository;
use Core\Usecase\Blog\ListPost\InputListPostDto;
use Core\Usecase\Blog\ListPost\ListPostUsecase;
use Core\Usecase\User\Create\CreateUserUsecase;
use Core\Usecase\User\Create\InputCreateUserDto;
use Core\Usecase\User\List\InputListUserDto;
use Core\Usecase\User\List\ListUserUsecase;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 1;
        $repository = new UserRepository();
        $usecase = new ListUserUsecase($repository);
        $users = $usecase->execute(new InputListUserDto($page));

        return view('user.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
            'name' => 'required|min:3',
            'email' => 'required|email',
            'gender' => 'required',
            'status' => 'required',
        ]);

        $input = new InputCreateUserDto(
            name: $request->get('name'),
            email: $request->get('email'),
            gender: $request->get('gender'),
            status: $request->get('status')
        );

        $repository = new UserRepository();
        $usecase = new CreateUserUsecase($repository);
        $user = $usecase->execute($input);

        return redirect('/user');
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
    public function showPost($userId)
    {
        $page = 1;
        $repository = new PostRepository;
        $usecase = new ListPostUsecase($repository);

        $posts = $usecase->execute(new InputListPostDto(
            page: $page,
            userId: $userId
        ));

        //dd($posts);

        return view('user.post_list', compact('posts', 'userId'));
    }
}
