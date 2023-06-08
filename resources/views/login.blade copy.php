<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
    .btn-google {
  background-color: #dd4b39;
  color: white;
  padding: 10px 20px;
  border-radius: 4px;
  text-decoration: none;
  display: inline-block;
}

.btn-google:hover {
  background-color: #c23321;
}

</style>
</head>
<body>
<div class="row justify-content-center mt-5">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Login</h1>
                </div>
                <div class="card-body">
                    @include('_message')
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3">
                            <div class="mb-1">
                                <div class="d-grid">
                                    <button class="btn btn-primary">Login</button>
                                </div>
                            </div>

                            <center>
                                <div class="d-grid mb-1">
                                    <a href="{{ route('register') }}" class="btn btn-google">
                                        <i class="fas fa-plus-circle"></i> Sign Up
                                      </a>
                                </div>

                                <div class="d-grid">
                                    <a href="{{ route('Glogin') }}" class="btn btn-google">
                                        <i class="fab fa-google"></i> Sign with Google
                                      </a>
                                </div>

                              <br>
                            </center>
                            <a href="{{url('forgot-password')}}">forgot password</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>