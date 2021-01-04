@extends('layouts.app')

@section('title')
    Login
@endsection

@section('body')
    <form action="{{ route('admin.auth.action') }}" method="post">
        @csrf
        <input type="email" name="email" id="email" placeholder="Input your email"><br>
        <input type="password" name="password" id="password" placeholder="Input your password"><br>

        <p>
            <button>Submit</button>
        </p>
    </form>
@endsection
