<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.9/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-yEPZ7jP9S0QKiUQ0m3jjsO4ProIW7wvR9gXkI7JOGa2XVsw53Yke2bsdkBbjmmiX" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h2 class="text-center my-5">Login</h2>

        <form action="{{ route('login.store') }}" method="POST" class="col-4 mx-auto">
            @csrf

            <div class="my-3">
                <label for="" class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror">

                @error('email')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="my-3">
                <label for="" class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">

                @error('password')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <p>If not acc => <a href="{{ route('register') }}">register</a></p>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
