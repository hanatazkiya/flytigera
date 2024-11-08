<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tempat Lama</title>
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
                        <a class="nav-link active" aria-current="page" href="/admin/places/create-place">Post Tempat Baru</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/admin/places">Tempat Wisata</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Opsi Pengguna
                        </a>
                        
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="">Pesanan Tempat</a></li>
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


    <form class="w-50 m-5 container m-auto py-5" method="post" action="/admin/places/update" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="place_id" value="{{ $id }}">

        <div class="mb-3">
            <label class="form-label" for="header_image">Gambar Header (Kosongkan Jika Tidak Ingin Update)</label>
            <input class="form-control" type="file" name="header_image">
            
            @if($errors->get('header_image'))
            <a class="text-danger mt-1 text-decoration-none">
                {{$errors->get('header_image')[0]}}
            </a>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label" for="name">Nama Tempat</label>
            <input required class="form-control" type="text" name="name" value="{{ $name }}">

            @if($errors->get('name'))
            <a class="text-danger mt-1 text-decoration-none">
                {{$errors->get('name')[0]}}
            </a>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label" for="description">Deskripsi Lengkap</label>
            <textarea required class="form-control" type="text" name="description" style="height: 200px;">{{ $description }}</textarea>

            @if($errors->get('description'))
            <a class="text-danger mt-1 text-decoration-none">
                {{$errors->get('description')[0]}}
            </a>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label" for="short_description">Deskripsi Singkat</label>
            <input required class="form-control" name="short_description" value="{{ $short_description }}"></input>

            @if($errors->get('short_description'))
            <a class="text-danger mt-1 text-decoration-none">
                {{$errors->get('short_description')[0]}}
            </a>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label" for="price">Harga Per Tiket</label>
            <input required class="form-control" type="number" name="price" value="{{ $price }}">

            @if($errors->get('price'))
            <a class="text-danger mt-1 text-decoration-none">
                {{$errors->get('price')[0]}}
            </a>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label" for="slug">Slug Halaman Wisata</label>
            <input required class="form-control" type="text" name="slug" value="{{ $slug }}">

            @if($errors->get('slug'))
            <a class="text-danger mt-1 text-decoration-none">
                {{$errors->get('slug')[0]}}
            </a>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label" for="embedded_maps">Embedded Maps Tempat Wisata</label>
            <input required class="form-control" type="text" name="embedded_maps" value="{{ $embedded_maps }}">

            @if($errors->get('embedded_maps'))
            <a class="text-danger mt-1 text-decoration-none">
                {{$errors->get('embedded_maps')[0]}}
            </a>
            @endif
        </div>

        <button type="submit" class="btn w-100 mb-5 bg-orange-to-whitesmoke">Post Data</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>