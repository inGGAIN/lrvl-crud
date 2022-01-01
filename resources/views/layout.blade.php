<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel CRUD</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css">

    <!-- BOOTSTRAP 5.0.2 -->
    <!-- OFFLINE BOOTSTRAP  -->
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <!-- STARTBOOTSTRAP -->
    <link rel="stylesheet" href="startbootstrap/style.css">
    <!-- ONLINE BOOTSTRAP  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- FONTAWESOME -->
    <script src="https://kit.fontawesome.com/7742704fc2.js" crossorigin="anonymous"></script>
    <!-- Google Icon  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Ionic Icon  -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
</head>

<body>
    <!-- SIDEBAR  -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <div class="container">
            <div class="nav navbar-expand-sm">
                <h1 href="#" class="navbar-brand">{{ config('app.name') }}</h1>
                @auth
                    <div style="color: white;" class="text-center"><span class="material-icons">
                            face
                        </span>
                        <h3 class="text-capitalize">{{ Auth::user()->username }}</h3> ({{ Auth::user()->name }})
                    </div>
                @endauth
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 btn-group text-nowrap bd-highlight" role="button">
                    <li class="nav-item active">
                        <a href="{{ route('home') }}" class="btn btn-primary border-start" aria-current="page"><span
                                class="fa fa-list-ul"></span> Home</a>
                    </li>
                    @auth
                        <li class="nav-item active">
                            <a href="{{ route('post.index') }}" class="btn btn-primary"><span
                                    class="fa fa-list"></span> Post</a>
                        </li>
                        <li class="nav-item active">
                            <a href="{{ route('user.index') }}" class="btn btn-primary"><i class="fa fa-users"></i>
                                Users</a>
                        </li>
                        <li class="nav-item active ">
                            <a href="#" class="btn btn-primary dropdown-toggle" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-th-list"></i> Category</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li class="">
                                    <?php foreach (\App\Models\Category::all() as $category) : ?>
                                    <a class="dropdown-item"
                                        href="{{ route('post.view', ['id_category' => $category->id_category]) }}">{{ $category->name_category }}</a>
                                    <?php endforeach ?>
                                </li>
                            </ul>
                        </li>
                    @endauth
                    <li class="nav-item active">
                        <a href="{{ route('home') }}" class=" btn btn-primary"><i class="far fa-id-card"></i>
                            Contact</a>
                    </li>
                    <li class="nav-item active ">
                        <a href="{{ route('about') }}" class=" btn btn-primary"><i class="far fa-question-circle"></i>
                            About Us</a>
                    </li>
                </ul>
                <!-- SEARCH BAR  -->
                <div class="container">
                    <form action="#" class="form-inline my-2 my-lg-0">
                        <input type="search" class="form-control mr-sm-2 rounded-pill" placeholder="Search"
                            aria-label="Search"></input>
                    </form>
                </div>
                @guest
                    <!-- LOGIN FORM  -->
                    <div class="collapse navbar-collapse rounded-pill" id="navbarSupportedContent">
                        <button class="btn text-nowrap bd-highlight" role="button">
                            <a href="{{ route('login') }}" class="btn btn-primary"><i class="fa fa-user-circle"></i> Log
                                In</a>
                        </button>

                    </div>
                @endguest
                @auth
                    <div class="dropdown">
                        <button class="btn btn-primary rounded-pill" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="material-icons ">
                                settings
                            </span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li class=""><span class=""> </span></li>
                            <li><a class="dropdown-item" href="{{ route('password') }}"><span
                                        class="fa fa-key"></span> Password</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-power-off"></i>
                                    Log Out</a></li>
                            <li>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
        </div>
    </nav>
    <div class="container">
        <br>
        @yield('content')
    </div>
</body>

</html>
