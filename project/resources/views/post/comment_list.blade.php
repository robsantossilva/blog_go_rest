@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>{{ __('Comments') }}</h1>
                    <a type="button" href="{{ route('comment.create', ['postId'=> $postId]) }}" class="btn btn-primary">Create</a>
                </div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Post ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Body</th>
                          </tr>
                        </thead>

                        <tbody>

                            @if (count($comments) >= 1)
                                @foreach($comments as $c)
                                <tr>
                                    <th scope="row">{{$c->id}}</th>
                                    <td>{{$c->post_id}}</td>
                                    <td>{{$c->name}}</td>
                                    <td>{{$c->email}}</td>
                                    <td>{{$c->body}}</td>
                                </tr>
                                @endforeach

                            @else

                            <tr>
                                <th scope="row" colspan="5">Nennhum post encontrado</th>
                            </tr>

                            @endif

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
