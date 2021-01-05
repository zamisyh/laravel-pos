@extends('layouts.app')

@section('title')
    Login
@endsection

@section('body')
<div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">POS - Login</h1>

                    @if (session()->get('success_login'))
                        <script>
                            var url = "{{ route('admin.home') }}";
                             setTimeout(function(){
                                window.location = url;
                            },3000);
                        </script>
                    @endif

                  </div>
                  <form class="user" action="{{ route('admin.auth.action') }}" method="post">
                    @csrf
                    <div class="form-group">
                      <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid': '' }}" name="email" id="email" aria-describedby="email"
                        placeholder="Enter Email Address" value="{{ old('email') }}">
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid': '' }}" id="password" name="password" placeholder="Password" value="{{ old('password') }}">
                      <p class="text-danger">{{ $errors->first('password') }}</p>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember
                          Me</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <button class="btn btn-primary btn-block">Login</button>
                    </div>


                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="font-weight-bold small" href="{{ route('admin.auth.regView') }}">Create an Account!</a>
                  </div>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
