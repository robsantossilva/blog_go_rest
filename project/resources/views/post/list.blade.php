@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Users') }}
                    <a type="button" href="{{ route('user.create') }}" class="btn btn-primary float-end">Create</a>
                </div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>

                        <tbody>

                            @if (count($users) >= 1
                                @foreach($users as $u)
                                <tr>
                                    <th scope="row">{{$u->id}}</th>
                                    <td>{{$u->name}}</td>
                                    <td>{{$u->email}}</td>
                                    <td>{{$u->gender}}</td>
                                    <td>{{$u->status}}</td>
                                    <td><a href="/user/{{$u->id}}/post">View Posts</a></td>
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
