@extends('layout')

@section('main')


<title>Change-Password</title>


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
              <form method="POST" class="row g-3" onsubmit="return check()" action="/change-password">
                @csrf
                <div class="form-group">
                  <label for=""><i class="bi bi-key me-1"></i>Password</label>
                  
                  <input type="password" name="password" placeholder="Enter password" id="psw" class="form-control" >
                  <span class="text-danger text-md">{{ $errors->first('password') }}</span>

                </div>
                <div class="form-group">
                    <label for=""><i class="bi bi-key me-1"></i>Confirm Password</label>
                    <input type="password" class="form-control" placeholder="Confirm password" id="cpsw" name="password_confirmation" >
                    <span id="ce" class="text-danger text-md">{{ $errors->first('password_confirmation') }}</span>
                  </div>
                  <input type="hidden" value="{{$token}}" name="token">
                <button class="btn btn-success form-control">Create Password</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      function check(){
      var decimal=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
      var lower=/[a-z]/g
      var upper=/[A-Z]/g
      var num=/[0-9]/g
      var char=/[^a-zA-Z\d]/g
      var str = document.getElementById("psw").value;
      var cpsw = document.getElementById("cpsw").value;
      if(!str.match(lower)){
        document.getElementById("ce").innerText='Password must contain atleast one lowercase character';
        // e.preventDefault()
        return false
      }
      else if(!str.match(upper)){
        document.getElementById("ce").innerText='Password must contain atleast one uppercase character';
        // e.preventDefault()
        return false
      }
      else if(!str.match(num)){
        document.getElementById("ce").innerText='Password must contain atleast one number';
        // e.preventDefault()
        return false
      }
      else if(!str.match(char)){
        document.getElementById("ce").innerText='Password must contain atleast one special character';
        // e.preventDefault()
        return false
      }
      else if(!(str.length>=8)){
        document.getElementById("ce").innerText='Password length must be greater than or equal to 8';
        // e.preventDefault()
        return false
      }
      else if(str!=cpsw){
        // alert("Passwords don't match");
        document.getElementById("ce").innerText="Passwords don't match"
        return false
      }
      else{
        return true
      }
      return false
    }
    </script>

@endsection

