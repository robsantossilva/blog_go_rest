@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>{{ __('Posts') }} / <small style="font-size: 18px;">User: {{$userId}}</small></h1>
                    <a type="button" href="{{ route('post.create',['userId'=>$userId]) }}" class="btn btn-primary">Create</a>
                </div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col" style="width: 10%">User ID</th>
                            <th scope="col" style="width: 30%">Title</th>
                            <th scope="col" style="width: 50%">Body</th>
                            <th scope="col" style="width: 10%"></th>
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
                                    <td><a href="/post/{{$p->id}}/comment">Comments</a></td>
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
