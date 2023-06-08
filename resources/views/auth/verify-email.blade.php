<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify-email</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('dist/css/verify-email.css')}}">
</head>

<body>
    <div class="container">
        @include('_messageverify')

        <h1>Please confirm your email</h1>
        <a href="{{url('resend-email')}}">Resend Email</a>
    </div>
    <div style="position: fixed; bottom: 10px; right: 10px;">
        <form action="{{ route('logout') }}" method="POST" role="search">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Logout</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
