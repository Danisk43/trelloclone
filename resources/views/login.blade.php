
<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
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
              <p class="card-text">Login</p></div>
            <div class="card-body">
              <form method="POST" action="/login">
                @csrf
                <div class="form-group">
                  
                  <label for=""> <i class="bi bi-envelope"></i>Email</label>
                  <input type="email" name="email" placeholder="Enter email" class="form-control" >
                  <span style="color:red; margin-left:4px; font-size:13px;">{{ $errors->first('email') }}</span>
                </div>
                <div class="form-group">
                  <label for=""><i class="bi bi-key"></i>Password</label>
                  
                  <input type="password" name="password" placeholder="Enter password" class="form-control" >
                  <span style="color:red; margin-left:4px; font-size:13px;">{{ $errors->first('password') }}</span>
                </div>
                <a class="link-primary" href="/forgot-password">Forgot Password?</a>
                <button class="btn btn-success form-control">Login</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>