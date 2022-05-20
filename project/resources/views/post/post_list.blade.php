@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Posts') }}
                    <a type="button" href="{{ route('post.create') }}" class="btn btn-primary float-end">Create</a>
                </div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Body</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>

                        <tbody>

                            @if (count($posts) >= 1)
                                @foreach($posts as $p)
                                <tr>
                                    <th scope="row">{{$p->id}}</th>
                                    <td>{{$p->user_id}}</td>
                                    <td>{{$p->title}}</td>
                                    <td>{{$p->body}}</td>
                                    <td><a href="/user/{{$p->id}}/post">View Posts</a></td>
                                </tr>
                                @endforeach
                            @endif

                            <tr>
                                <th scope="row" colspan="5">Nennhum post encontrado</th>
                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
