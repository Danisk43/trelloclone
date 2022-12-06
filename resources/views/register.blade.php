    @extends('layout')

    @section('main')

    <title>Register</title>


    <div class="container d-flex flex-column" style="height:100vh">
        <div class="outer pt-5">
            <h1 class="logo">Taskit</h1>
            <div class="upper-right">
                <p class="up-para me-4">Already have an account?</p>

                <a href="/login"> <button class="upper-btn btn btn-success form-control">Login</button></a>
            </div>
        </div>

        <div class="row justify-content-center align-items-center" style="flex-grow:1;">
            <div class="col-4">
                <div class="flash-message">
                    @if (Session::has('success'))
                        <p class="alert alert-success text-center">{{ Session::get('success') }}</p>
                    @endif
                    @if (Session::has('failure'))
                        <p class="alert alert-danger text-center">{{ Session::get('failure') }}</p>
                    @endif
                </div>
                <div class="card">
                    <div class="card-header">
                        <p class="card-text">Register</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="row g-3" onsubmit="return validatePass()" action="/register">
                            @csrf
                                <div class="col-md-6">
                                    <label for=""><i class="bi bi-pen me-1"></i>First Name</label>
                                    <input type="text" required name="first_name" class="form-control"
                                        placeholder="Enter first name" value="{{ old('first_name') }}">
                                        <span class="text-danger text-md"
                                            >{{ $errors->first('first_name') }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label for=""><i class="bi bi-pen me-1"></i>Last Name</label>
                                    <input type="text" required name="last_name" class="form-control"
                                        placeholder="Enter last name" value="{{ old('last_name') }}">
                                        <span class="text-danger text-md"
                                        >{{ $errors->first('last_name') }}</span>
                                </div>


                                <div class="col-md-12">
                                    <label for=""><i class="bi bi-envelope me-1"></i>Email</label>
                                    <input type="email" required name="email" class="form-control" placeholder="Enter email">
                                    <span
                                    class="text-danger text-md">{{ $errors->first('email') }}</span>
                                </div>

                                <div class="col-md-6">
                                    <label for=""><i class="bi bi-key me-1"></i>Password</label>
                                    <input type="password" required name="password" class="form-control" id="psw"
                                        placeholder="Enter password">
                                    <span
                                    class="text-danger text-md">{{ $errors->first('password') }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label for=""><i class="bi bi-key me-1"></i>Confirm Password</label>
                                    <input type="password" required class="form-control" id="cpsw"
                                        placeholder="Confirm Password" name="password_confirmation">
                                    </div>
                                    <span>Use 8 or more characters with a mix of letters, numbers & symbols</span>
                                    <span id="ce"
                                    class="text-danger text-md">{{ $errors->first('password_confirmation') }}</span>

                                <button class="btn btn-success form-control" type="submit">Register</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validatePass() {
            var decimal = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
            var lower = /[a-z]/g
            var upper = /[A-Z]/g
            var num = /[0-9]/g
            var char = /[^a-zA-Z\d]/g
            var str = document.getElementById("psw").value;
            var cpsw = document.getElementById("cpsw").value;
            if (!str.match(lower)) {
                document.getElementById("ce").innerText = 'Password must contain atleast one lowercase character';
                // e.preventDefault()
                return false
            } else if (!str.match(upper)) {
                document.getElementById("ce").innerText = 'Password must contain atleast one uppercase character';
                // e.preventDefault()
                return false
            } else if (!str.match(num)) {
                document.getElementById("ce").innerText = 'Password must contain atleast one number';
                // e.preventDefault()
                return false
            } else if (!str.match(char)) {
                document.getElementById("ce").innerText = 'Password must contain atleast one special character';
                // e.preventDefault()
                return false
            } else if (!(str.length >= 8)) {
                document.getElementById("ce").innerText = 'Password length must be greater than or equal to 8';
                // e.preventDefault()
                return false
            } else if (str != cpsw) {
                // alert("Passwords don't match");
                document.getElementById("ce").innerText = "Passwords don't match"
                return false
            } else {
                return true
            }
            return false
        }
    </script>

    @endsection

