<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <link rel="stylesheet" href="/css/history.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="w-50 container row vw-3 bg-body shadow-lg m-auto py-3" style="margin-top : 9vh !important">
        <h3 class="text-center">Hai Admin, Silahkan Login</h3>
    </div>

    <div class="w-50 container row row-col-2 vw-3 pt-4 pb-5 mx-auto bg-body shadow" style="margin-top: 1vh;">
        <div class="col-5 mx-3">
            <img class="py-4 img img-fluid w-100" src="/images/guest-logo.png">

            @if(session()->has('login_error_log'))
            <div class="alert alert-danger d-flex align-items-center m-auto mt-2" role="alert" style="margin-bottom: 1vh;">
                <div class="w-auto m-auto">
                    {{ session('login_error_log') }}
                </div>
            </div>
            @endif
        </div>
    
        <form class="col-6 m-auto" method="post" action="/admin/login">
            @csrf
            <label for="username" class="form-label @error('username') is-invalid @enderror">Username</label>
            <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
            
            @error('username')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

            <label for="password" class="form-label mt-3 @error('password') is-invalid @enderror">Password</label>
            <input type="password" name="password" class="form-control" required>

            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

            <div class="row m-auto mt-4">
                <button type="submit" class="btn col-12 m-auto bg-orange-to-whitesmoke">Login</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>