@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Comment') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('comment.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="post_id" class="col-md-4 col-form-label text-md-end">{{ __('Post ID') }}</label>

                            <div class="col-md-6">

                                <input type="hidden" id="post_id" name="post_id" value="{{ $postId }}">

                                <input

                                    type="text"
                                    class="form-control @error('post_id') is-invalid @enderror"

                                    value="{{ $postId }}"
                                    required
                                    disabled
                                    autocomplete="post_id"
                                    autofocus>

                                @error('post_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}"
                                required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}"
                                required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="body" class="col-md-4 col-form-label text-md-end">{{ __('Body') }}</label>

                            <div class="col-md-6">
                                <textarea id="body" type="body"
                                class="form-control @error('body') is-invalid @enderror"
                                name="body"
                                required autocomplete="body"
                                maxlength="255"
                                >{{ old('body') }}</textarea>

                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
