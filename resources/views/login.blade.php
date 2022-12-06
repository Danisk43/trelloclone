@extends('layout')

@section('main')

<title>Login</title>

    <div class="container d-flex flex-column" style="height:100vh">
      <div class="outer pt-5">
      <h1 class="logo">Taskit</h1>
      <div class="upper-right">
      <p class="up-para me-4">Don't have an account?</p>

      <a href="/register"> <button class="upper-btn btn btn-success form-control">Register</button></a>
      </div>
      </div>
      <div class="row justify-content-center align-items-center" style="flex-grow:1;">
        <div class="col-4">
        <div class="flash-message">
                    @if(Session::has('success'))
                        <p class="alert alert-success text-center">{{Session::get('success')}}</p>
                    @endif
                    @if(Session::has('failure'))
                    <p class="alert alert-danger text-center">{{Session::get('failure')}}</p>
                    @endif
            </div>
          <div class="card">
            <div class="card-header">
              <p class="card-text">Login</p></div>
            <div class="card-body">
              <form method="POST" class="row g-3" action="/login">
                @csrf
                <div class="col-md-12">
                  <label for=""> <i class="bi bi-envelope me-1"></i>Email</label>
                  <input type="email" name="email" placeholder="Enter email" class="form-control" required>
                  <span class="text-danger text-md">{{ $errors->first('email') }}</span>
                </div>
                <div class="col-md-12">
                  <label for=""><i class="bi bi-key me-1"></i>Password</label>
                  <input type="password" name="password" placeholder="Enter password" class="form-control" required >
                  <span class="text-danger text-md">{{ $errors->first('password') }}</span>
                </div>
                <a class="link-primary" href="/forgot-password">Forgot Password?</a>
                <button class="btn btn-success form-control">Login</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    @endsection
