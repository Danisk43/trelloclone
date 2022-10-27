<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-4">
          <div class="flash-message">
                    @if(Session::has('success'))
                        <p class="alert">{{Session::get('success')}}</p>
                    @endif
              </div>
          <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
              <form method="POST" action="/api/register">
              @csrf
                <div class="form-group">
                    <label for="">First Name</label>
                    <input type="text" name="first_name" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="">Last Name</label>
                    <input type="text" name="last_name" class="form-control">
                  </div>
                <div class="form-group">
                  <label for="" >Email</label>
                  <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">Password</label>
                  <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" class="form-control">
                  </div>
                <button class="btn btn-success form-control">Register</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>