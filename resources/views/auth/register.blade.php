@extends('layouts.app')

@section('title', 'Signup')

@section('body')
    <form action="{{ route('admin.auth.action.signup') }}" method="post">
        @csrf
        <input type="text" name="name" id="name" placeholder="Masukkan username"><br>
        <input type="email" name="email" id="email" placeholder="Input your email"><br>
        <input type="password" name="password" id="password" placeholder="Input your password"><br>
        <input type="password" name="confirm_password" placeholder="Masukkan confirm password"><br>

        <button>Signup</button>


        @if ($errors->any())
            @foreach ($errors->all() as $err)
                {{ $err }}
            @endforeach
        @endif
    </form>
@endsection
