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
    <script>
        var list_id = [];
        var list_button_id = [];
    </script>

    <div>
        <div class="modal fade" id="change-warning-message" tabindex="-1" aria-labelledby="changeReservationModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changeReservationModal">Tips dan Rekomendasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
                    Lakukan seleksi dengan cara memilih berdasarkan nama, anda bisa mencari berdasarkan nama yang anda butuhkan 
                    ketika anda melihat bahwa peruntukan tanggal pemesanan tiket sudah semakin dekat.
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn bg-orange-to-whitesmoke" data-bs-dismiss="modal">Mengerti</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                        <a class="nav-link" aria-current="page" href="/admin/places/create-place">Post Tempat Baru</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/admin/places">Tempat Wisata</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Opsi Pengguna
                        </a>
                        
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-center" href="/admin/ticket">Periksa Pesanan</a></li>
                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form class="dropdown-item" action="/admin/logout" method="post">
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

    <div class="row my-4 mx-3">
        <div class="col-12 w-25 mx-3">
            <div class="row container shadow bg-body rounded rounded-start">
                <div class="col text-center py-4">
                    <h4>{{ session()->get('name') }}</h4>
                </div>
            </div>

            <form class="mt-2 row container shadow bg-body rounded rounded-start" method="post" action="/admin/ticket/find">
                @csrf
                <div class="row text-center pt-4">
                    <label for="find-for" class="form-label"> Cari Berdasarkan Pengguna: </label>
                </div>

                <div class="row text-center pt-1">
                    <input type="text" class="shadow-sm rounded form-control" name="find-for">
                </div>

                <div class="row text-center pb-4 pt-3">
                    <button class="btn rounded shadow bg-orange-to-whitesmoke" type="submit">Cari Pengguna</button>
                </div>
            </form>

            <div class="row container shadow bg-body rounded mt-2 py-4">
                <div class="col-12 text-left bg-warning rounded shadow py-3">
                    <svg style="margin-left: 1rem;" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                        <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z"/>
                        <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z"/>
                        <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5"/>
                    </svg>
                
                    <a class="fs-6 mx-3 text-decoration-none color-unset" href="/admin/ticket">List Pemesanan Tiket</a>
                </div>

                <hr class="my-4">

                <div class="col-12 text-left">
                    <svg style="margin-left : 1rem;" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                    </svg>

                    <a class="fs-6 mx-3 text-decoration-none color-unset btn px-0" href="/admin/places/create-place">Post Untuk Tempat Baru</a>
                </div>
                
                <hr class="my-4">

                <div class="col-12 text-left" id="change-warning-message-listener">
                    <svg style="margin-left: 1rem;" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                    </svg>

                    <a class="fs-6 mx-3 text-decoration-none color-unset btn px-0">Dapatkan Rekomendasi</a>
                </div>
            </div>

        </div>

        <div class="col bg-info w-75 mx-0 shadow-lg bg-body rounded rounded-start">
            <div class="container my-5">
                <div class="">
                    <h2> History Pesanan {{ $user_target }} </h2>
                </div>
            </div>

            <hr class="mb-5">

            <div class="container d-block">
                @foreach($datas as $history_data)
                <script>
                    list_button_id.push("{{ $history_data->id }}");
                </script>

                <div class="card mb-3 shadow-lg p-1 mb-5 bg-body rounded">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ $history_data->place->header_image }}" class="m-3 shadow-lg bg-body rounded img-fluid rounded-start" alt="{{ $history_data->place->name }}">
                        </div>

                        <div class="container col-md-8">
                            <div class="row card-body mx-3">
                                <h5 class="col-12 card-title fs-2 mt-3">
                                    {{ $history_data->place->name }}
                                </h5>

                                <a class="col-12 card-text text-decoration-none color-unset">
                                    <small class="text-body-secondary">
                                        Pesan Pada : {{ $history_data->updated_at }}
                                    </small>
                                </a>
                                
                                <a class="col-12 card-text text-decoration-none color-unset">
                                    <small class="text-body-secondary">
                                        Pesan Untuk : {{ $history_data->booking_for }}
                                    </small>
                                </a>

                                <a class="col-12 card-text text-decoration-none color-unset">
                                    <small class="text-body-secondary">
                                        Total : {{ $history_data->total }} ({{ $history_data->total / $history_data->place->price }} Tiket)
                                    </small>
                                </a>

                                <a class="col-12 card-text text-decoration-none color-unset">
                                    <small class="text-body-secondary">
                                        Dipesan Oleh : <b>{{ $history_data->user->name }}</b>
                                    </small>
                                </a>
                            </div>       
                        </div>
                    </div>
                </div>

                <script>
                    list_id.push('listener-{{ $history_data->id }}')
                </script> 

                @endforeach
            </div>
        </div>
    </div>

    <script> 
        counter = 0;
        list_id.forEach(function (id) {
            document.getElementById(list_button_id[counter]).addEventListener('click', () => {
                let target_id = "#" + id;
                new bootstrap.Modal(target_id).show();
            }); counter += 1;
        });
    </script>

    <script> 
        document.getElementById("change-warning-message-listener").addEventListener('click', () => {
            let target_id = "#change-warning-message";
            new bootstrap.Modal(target_id).show();
        }); 
    </script>

    <div class="modal fade" id="cancelReservationModal" tabindex="-1" aria-labelledby="cancelReservationModalLabel" aria-hidden="true">
        <!-- modal fade -->
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>