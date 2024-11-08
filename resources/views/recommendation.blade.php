<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Pemesanan</title>
    <link rel="stylesheet" href="/css/history.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    @auth
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

    <div class="modal fade" id="change-booking-warning" tabindex="-1" aria-labelledby="changeReservationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeReservationModalLabel">Peringatan Petunjuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    Pilih tempat yang ada pada history anda, lalu tekan tombol ubah jadwal untuk mengubah
                    jadwal sesuai yang anda inginkan.
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn bg-orange-to-whitesmoke" data-bs-dismiss="modal">Mengerti</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-4 mx-3">
        <div class="col-12 w-25 mx-3">
            <div class="row container shadow bg-body rounded rounded-start">
                <div class="col text-center py-4">
                    <h4>{{ auth()->user()->name }}</h4>
                </div>
            </div>

            <div class="row container shadow bg-body rounded mt-2 py-4">
                <div class="col-12 text-left">
                    <svg style="margin-left: 1rem;" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                        <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z"/>
                        <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z"/>
                        <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5"/>
                    </svg>

                    <a class="mx-3 fs-6 text-decoration-none color-unset" href="/history">History Pesanan Anda</a>
                </div>

                <hr class="my-4">

                <div class="col-12 text-left">
                    <svg style="margin-left: 1rem;" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>

                    <a class="mx-3 fs-6 text-decoration-none color-unset btn" id="change-booking-warning-listener">Ubah Tanggal Booking</a>
                </div>
                
                <hr class="my-4">

                <div class="col-12 text-left bg-warning rounded shadow py-3">
                    <svg style="margin-left: 1rem;" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                    </svg>

                    <a class="mx-3 fs-6 text-decoration-none color-unset" href="/history/recommendation">Dapatkan Rekomendasi</a>
                </div>
            </div>
        </div>

        <div class="col bg-info w-75 mx-0 shadow-lg bg-body rounded rounded-start">
            <div class="container my-5">
                <div class="">
                    <h2> Rekomendasi Untuk Anda </h2>
                </div>
            </div>

            <hr class="mb-5">
            
            <div class="container row row-col-2">
                @foreach($datas as $place_data)
                <div class="limited-content col-6 card mb-3 text-bg-primary shadow-lg mb-5 bg-body rounded">
                    <div class="row g-0">
                        <div class="col-md-0">
                            <img src="{{ $place_data->header_image }}" class="text-center shadow-lg bg-body rounded img-fluid rounded-start mt-3" alt="{{ $place_data->name }}">
                        </div>

                        <div class="col-md-12">
                            <div class="row card-body">
                                <h5 class="col-12 card-title fs-2">{{ $place_data->name }}</h5> <hr class="mt-2">
                                <p class="col-12 card-text mb-4"><small class="text-body-secondary">{{ $place_data->short_description }}</small></p>
                                <a href="/places/place/{{ $place_data->slug }}" class="m-auto col-12 btn bg-orange-to-whitesmoke">Booking Sekarang</a>
                            </div>       
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            </div>
            
        </div>
    </div>

    <script> 
        document.getElementById("change-booking-warning-listener").addEventListener('click', () => {
            let target_id = "#change-booking-warning";
            new bootstrap.Modal(target_id).show();
        }); 
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @endauth
</body>
</html>