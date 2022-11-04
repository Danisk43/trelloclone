<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

  </head>

  <body>
    <div class="container mt-5">
    <div class="outer">
      <h1 class="logo">Taskit</h1>
      <div class="upper-right">
      <p class="up-para">Already have an account?</p>
      
      <a href="/login"> <button class="upper-btn btn btn-success form-control">Login</button></a>
      </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-4">
          <<div class="flash-message">
                    @if(Session::has('success'))
                        <p class="alert alert-success">{{Session::get('success')}}</p>
                    @endif
                    @if(Session::has('failure'))
                    <p class="alert alert-danger">{{Session::get('failure')}}</p>
                    @endif
            </div>
          <div class="card">
            <div class="card-header"><p class="card-text">Register</p></div>
            <div class="card-body">
              <form method="POST" class="row g-3" onsubmit="return check()" action="/register">
              @csrf
              <div class="row">
                <div class="col-md-6">
                    <label for=""><i class="bi bi-pen"></i>First Name</label>
                    <input type="text" name="first_name" class="form-control" placeholder="Enter first name" value="{{old('first_name')}}" >
                  </div>
                  <div class="col-md-6">
                    <label for=""><i class="bi bi-pen"></i>Last Name</label>
                    <input type="text" name="last_name" class="form-control" placeholder="Enter last name"  value="{{old('last_name')}}" >
                  </div>
                  <div class="col">
                  <span style="color:red; margin-left:4px; font-size:13px;">{{ $errors->first('first_name') }}</span>
                  <span style="color:red; margin-left:24px; font-size:13px;">{{ $errors->first('last_name') }}</span>
</div>

                <div class="col-md-12">
                  <label for="" ><i class="bi bi-envelope"></i>Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Enter email" >
                  <span style="color:red; margin-left:4px; font-size:13px;">{{ $errors->first('email') }}</span>
                </div>

                <div class="col-md-6">
                  <label for=""><i class="bi bi-key"></i>Password</label>
                  <input type="password" name="password" class="form-control" id="psw" placeholder="Enter password" >
                  <span style="color:red; margin-left:4px; font-size:13px;">{{ $errors->first('password') }}</span>
                </div>
                <div class="col-md-6">
                    <label for=""><i class="bi bi-key"></i>Confirm Password</label>
                    <input type="password" class="form-control" id="cpsw" placeholder="Confirm Password" name="password_confirmation" >
                    <span id="ce" style="color:red; margin-left:7px; font-size:13px;">{{ $errors->first('password_confirmation') }}</span>
                  </div>
                  
                  <button class="btn btn-success form-control" type="submit" >Register</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
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
  </body>
</html>