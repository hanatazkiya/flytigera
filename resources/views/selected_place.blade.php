<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $name }}</title>
    <link href="/css/history.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light p-fixed bg-transparent">
        <div class="m-3 mt-0 mb-0 container-fluid">
            <a class="navbar-brand" href="#">
                Flytigera
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Beranda</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/places">Tempat Wisata</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Opsi Pengguna
                        </a>
                        
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/history">Pesanan Anda</a></li>
                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form class="dropdown-item" action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="btn w-100 h-100">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="row container shadow-lg bg-body rounded img-fluid mt-5 pb-5 m-auto">
        <div class="col-12 container">
            <img class="m-auto w-100 my-4 shadow-lg bg-body rounded img-fluid" src="{{ $header_image }}" alt="images">
        </div>

        <div class="col-12 container mx-3 mt-3">
            <h1>{{ $name }}</h1>
            <p> {!! $description !!} </p>
        </div>
    </div>

    <div class="container my-3 shadow-lg bg-body rounded img-fluid py-5">
        <div class="row container mb-5">
            <h2 class="text-center">Ayo, Booking Sekarang dan Nikmati Liburanmu!</h2>
            <hr class="mt-4">
        </div>

        <div class="row container mx-3 mt-3">
            <div class="col-6 container">
                {!! $embedded_maps !!}
            </div>

            <form class="col-5 mx-5" method="post" action="../reservation">
                @csrf
                <input type="hidden" value="{{ $id }}" name="place_id">
                <input type="hidden" id="price" value="{{ $price }}" name="price" required>

                <label for="booking_for" class="form-label">Booking Untuk: </label>
                <input class="form-control" type="date" name="booking_for" required> 

                @error('booking_for')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

                <label for="booking_total" class="form-label mt-3">Booking Total: </label>
                <input class="form-control" type="number" id="booking-total" name="booking_total" required> 

                @error('booking_total')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

                <label for="" class="form-label mt-3">Total Pembayaran:</label>
                <input class="form-control" id="booking-price" type="number" value="{{ $price }}" readonly>

                <button type="submit" class="form-control bg-orange-to-whitesmoke mt-3">
                    Pesan Sekarang
                </button>
            </form>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="/js/reservation.js"> </script>
</body>
</html>