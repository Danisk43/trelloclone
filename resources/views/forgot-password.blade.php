@extends('layout')

@section('main')

<title>Forgot-Password</title>


    <div class="container d-flex flex-column" style="height:100vh">
      <div class="outer pt-5">
      <h1 class="logo">Taskit</h1>
      <div class="upper-right">
      <p class="up-para me-4"></p>
      
      <a href="/login"> <button class="upper-btn btn btn-success form-control">Login</button></a>
      </div>
      </div>
      <div class="row justify-content-center align-items-center" style="flex-grow:1;">
        <div class="col-4">
        <div class="flash-message">
                    @if(Session::has('success'))
                        <p class="alert alert-success">{{Session::get('success')}}</p>
                    @endif
                    @if(Session::has('failure'))
                    <p class="alert alert-danger">{{Session::get('failure')}}</p>
                    @endif
            </div>
          <div class="card">
            <div class="card-header">
              <p class="card-text">Change Password</p></div>
            <div class="card-body">
              <form method="POST" class="row g-3" action="/forgot-password">
                @csrf
                <div class="form-group">
                  
                  <label for=""> <i class="bi bi-envelope me-1"></i>Email</label>
                  <input type="email" name="email" placeholder="Enter email" class="form-control" >
                  <span class="text-danger text-md">{{ $errors->first('email') }}</span>
                </div>
                <button class="btn btn-success form-control">Send Link</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    @endsection

