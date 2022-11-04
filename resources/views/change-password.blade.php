
<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change-password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="/css/style.css" rel="stylesheet">
  </head>
  <body>
    <div class="container mt-5">
      <div class="outer">
      <h1 class="logo">Taskit</h1>
      <div class="upper-right">
      <p class="up-para">Don't have an account?</p>
      
      <a href="/register"> <button class="upper-btn btn btn-success form-control">Register</button></a>
      </div>
      </div>
      <div class="row justify-content-center">
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
              <form method="POST" onsubmit="return check()" action="/change-password">
                @csrf
                <div class="form-group">
                  <label for=""><i class="bi bi-key"></i>Password</label>
                  
                  <input type="password" name="password" placeholder="Enter password" id="psw" class="form-control" >
                  <span style="color:red; margin-left:4px; font-size:13px;">{{ $errors->first('password') }}</span>

                </div>
                <div class="form-group">
                    <label for=""><i class="bi bi-key"></i>Confirm Password</label>
                    <input type="password" class="form-control" placeholder="Confirm password" id="cpsw" name="password_confirmation" >
                    <span style="color:red; margin-left:4px; font-size:13px;">{{ $errors->first('password_confirmation') }}</span>
                    <span id="ce" style="color:red; margin-left:7px; font-size:13px;"></span>
                  </div>
                  <input type="hidden" value="{{$token}}" name="token">
                <button class="btn btn-success form-control">Create Password</button>
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
