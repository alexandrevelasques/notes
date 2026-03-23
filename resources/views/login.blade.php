@extends('layouts.main_layout')
@section('content')
<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="card p-5 w-100 shadow" style="max-width: 480px">

        <!-- logo -->
        <div class="text-center p-3 mb-4">
            <img src="{{asset('assets/images/logo.png')}}" alt="Notes logo">
        </div>

        <!-- form -->
        <form action="/loginSubmit" method="post" novalidate>
            @csrf

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="email" class="form-control bg-dark text-info" name="text_username" value="{{old('text_username')}}" required>
                @error('text_username')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control bg-dark text-info" name="text_password" required>
                @error('text_password')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-secondary w-100">LOGIN</button>
            </div>
        </form>
        {{-- invalid login --}}
        @if(session('loginError'))
            <div class="alert alert-danger text-center">
                {{session('loginError')}}
            </div>
        @endif


    </div>
</div>
@endsection
