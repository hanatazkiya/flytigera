<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Keinginanmu</title>
    <link rel="stylesheet" href="/css/places.css">
    <link rel="stylesheet" href="/css/history.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <script> 
        var list_id = []; var pivot = 0;
        var list_button_id = [];
    </script>

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
                        <a class="nav-link active" href="/admin/places">Tempat Wisata</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

    <div class="row w-100">
        <div class="my-3 search-feature col-3 mb-5 mx-4 rounded">
            <div class="row container shadow bg-body rounded mt-3 m-auto">
                <div class="col text-center py-4">
                    <h4>{{ session('name') }}</h4>
                </div>
            </div>
        
            <form method="POST" action="" class="container mt-2 shadow-lg bg-body rounded py-4">
                @csrf
                <label class="form-label mb-1 mx-4" for="place-search"><a class="fs-4 text-decoration-none text-color-reset" >Cari Tempat Wisata</a></label>
                <input class="form-control mb-2 px-3 mb-3 mt-1 w-90 m-auto shadow-lg bg-body rounded " type="text" name="place-search" placeholder="Misalnya : tempat sejuk baturaden">
                <button class="btn bg-orange-to-whitesmoke mx-3 w-90" type="submit">Cari Sekarang</button>
            </form>
        </div>
        
        <div class="my-3 mb-5 col-8 px-0 mx-1">
            <div class="d-flex container shadow-lg bg-body rounded my-3 py-3 mx-1 px-4">
                <svg class="bi bi-search d-flex mx-1" xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
                
                <h5 class="mx-3 my-2 d-flex">{{ session('name') }}, Berikut ini adalah tempat yang anda buat:</h5>
            </div>

            @if(count($datas) > 1)
                <div class="row row-col-2">
                    @foreach ($datas as $data_place)
                        <form class="modal fade" id="listen-id-{{ $data_place->id }}" tabindex="-1" aria-labelledby="changeReservationModal" aria-hidden="true" method="post" action="/admin/places/delete">
                            @csrf
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="changeReservationModal">Peringatan Admin</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div> <input type="hidden" name="id" value="{{ $data_place->id }}">
                                    
                                    <div class="modal-body">
                                    Apakah anda yakin ingin menghapus tempat ini?
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-red-to-whitesmoke" data-bs-dismiss="modal">Tidak, Batalkan</button>
                                        <button type="submit" class="btn bg-orange-to-whitesmoke" data-bs-dismiss="modal">Ya, Saya Yakin</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <script> 
                            list_id.push('listen-id-{{ $data_place->id }}');
                        </script>

                        <form class="shadow card col-6 limited-content pb-2" method="post" action="/admin/places/edit">
                            @csrf
                            <img class="pt-3 rounded img-fluid image-content" src="{{ $data_place->header_image }}">            
                            <div class="card-body">
                                <div class="title">
                                    <h1>{{ $data_place->name }}</h1>
                                </div> <hr class="my-2">

                                <div class="short-desc">
                                    <p>{{ $data_place->short_description }}</p>
                                </div>

                                <div class="admin-name mb-4">
                                    <b><p>Uploaded By : {{ $data_place->admin->name }}</p></b>
                                </div> <input type="hidden" value="{{ $data_place->id }}" name="place_id">
                                
                                <div class="row container mt-4 mx-auto row-col-2 pb-3">
                                    <button class="col-3 m-auto btn bg-orange-to-whitesmoke shadow" type="submit">Ubah</button>
                                    <a class="col-5 m-auto btn bg-dark-cyan-to-whitesmoke shadow" href="/admin/places/{{ $data_place->slug }}">Lihat</a>
                                    <a class="col-3 m-auto btn bg-red-to-whitesmoke shadow" id="button-{{ $data_place->id }}">Hapus</a>
                                </div> 

                                <script> 
                                    list_button_id.push('button-{{ $data_place->id }}');
                                </script>

                                <div class="row container m-auto mb-4">
                                    <a href="" class="col-12 m-auto btn btn-warning shadow" style="color : whitesmoke;">
                                    </a>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>

            @else
                <div class="row">
                    @foreach ($datas as $data_place)
                        <div class="modal fade" id="listen-id-{{ $data_place->id }}" tabindex="-1" aria-labelledby="changeReservationModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="changeReservationModal">Peringatan Admin</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    
                                    <div class="modal-body">
                                    Apakah anda yakin ingin menghapus tempat ini?
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-red-to-whitesmoke" data-bs-dismiss="modal">Tidak, Batalkan</button>
                                        <button type="button" class="btn bg-orange-to-whitesmoke" data-bs-dismiss="modal">Ya, Saya Yakin</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script> 
                            list_id.push('listen-id-{{ $data_place->id }}');
                        </script>

                        <form class="shadow card col limited-content pb-2" action="/admin/places/edit" method="post">
                            @csrf
                            <img class="pt-3 rounded img-fluid image-content" src="{{ $data_place->header_image }}">            
                            <div class="card-body">
                                <div class="title">
                                    <h1>{{ $data_place->name }}</h1>
                                </div> <hr class="my-2">

                                <div class="short-desc">
                                    <p>{{ $data_place->short_description }}</p>
                                </div>

                                <div class="admin-name">
                                    <b><p>Uploaded By : {{ $data_place->admin->name }}</p></b>
                                </div> <input type="hidden" value="{{ $data_place->id }}" name="place_id">
                                
                                <div class="row row-col-3 pb-4">
                                    <button class="col-4 m-auto btn bg-orange-to-whitesmoke" type="submit">Lakukan Perubahan</button>
                                    <a class="col-4 m-auto btn bg-dark-cyan-to-whitesmoke py-4" href="/admin/places/{{ $data_place->slug }}">Lakukan Preview</a>
                                    <a class="col-4 m-auto btn bg-red-to-whitesmoke" id="button-{{ $data_place->id }}">Hapus Tempat Ini</a>
                                </div>
                            </div>
                        </form>

                        <script> 
                            list_button_id.push('button-{{ $data_place->id }}');
                        </script>
                    @endforeach
                </div>
            @endif
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>