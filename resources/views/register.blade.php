<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link href="/css/history.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="w-50 container row vw-3 bg-body shadow-lg m-auto py-3" style="margin-top : 9vh !important">
        <h3 class="text-center">Selamat Bergabung, Hollies!</h3>
    </div>

    <form method="post" action="/register/submit" class="w-50 container row vw-3 pt-4 pb-5 mx-auto bg-body shadow" style="margin-top: 1vh;">
        @csrf

        <div class="w-100 row row-col-2 container px-4 m-auto">
            <div class="col-6 m-auto mt-4">
                <label for="name" class="form-label @error('name') is-invalid @enderror">Nama Anda:</label>
                <input type="text" name="name" class="form-control bg-body shadow-sm" value="{{ old('name') }}" required>
                
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

                <label for="email" class="form-label mt-3 @error('email') is-invalid @enderror">Email Anda:</label>
                <input type="email" name="email" class="form-control bg-body shadow-sm" value="{{ old('email') }}" required>

                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        
            <div class="col-6 m-auto mt-4">
                <label for="username" class="form-label @error('username') is-invalid @enderror">Username:</label>
                <input type="text" name="username" class="form-control bg-body shadow-sm" value="{{ old('username') }}" required>
                
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

                <label for="password" class="form-label mt-3 @error('password') is-invalid @enderror">Password:</label>
                <input type="password" name="password" class="form-control bg-body shadow-sm" required>

                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="row m-auto mt-4 px-4 pb-2">
            <button type="submit" class="btn col-12 m-auto bg-orange-to-whitesmoke rounded shadow">Buat Akun Anda Sekarang</button>
        </div>

        @if(session()->has('warning_message'))
        <div class="row m-auto mt-4 px-4 pb-2">
            <a type="submit" class="btn col-12 m-auto bg-dark-cyan-to-whitesmoke rounded shadow">{{ session('warning_message') }}</a>
        </div>
        @endif
    </form>

    <a class="rounded text-whitesmoke text-decoration-none fs-5 w-50 container row vw-3 shadow-lg m-auto py-3 mt-2 bg-whitesmoke-to-red" href="/login">
        <span class="w-auto m-auto"> Batalkan Membuat Akun <span>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>