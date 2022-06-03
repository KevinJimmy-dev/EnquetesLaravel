<!DOCTYPE html>

<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

        <link rel="stylesheet" href="/css/style.css">
        <link rel="shortcut icon" href="/img/favicon.png" type="image/x-icon">

        <title>@yield('title')</title>
    </head>

    <body class="bg-light">

        <header class="bg-primary">
            <nav class="navbar">
                <div class="container-fluid">
                    <abbr title="Página Inicial">
                        <a class="navbar-brand" href="{{ route('index.poll') }}">
                            <img src="/img/favicon.png" alt="" width="30" height="24">
                        </a>
                    </abbr>

                    <h1>@yield('h1-title')</h1>
                    
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Ações</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>

                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                <li class="nav-item">
                                    <a class="nav-link @yield('activeIndex')" aria-current="page" href="{{ route('index.poll') }}">
                                        Inicio
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link @yield('activeCreate')" aria-current="page" href="{{ route('create.poll') }}">
                                        Criar Enquete
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </nav>
        </header>

        <div class="mb-0">

            @if (session('success'))
                <div class="alert alert-success text-center mb-0" role="alert">
                    <p class="msg-success">{{ session('success') }}</p>
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger text-center mb-0" role="alert">
                    <p class="msg-error">{{ session('error') }}</p>
                </div>
            @elseif(session('warning'))
                <div class="alert alert-warning text-center mb-0" role="alert">
                    <p class="msg-warning">{{ session('warning') }}</p>
                </div>
            @endif
            
        </div>

        <main class="container mt-4">
            <section class="">
                <h2 class="text-center">@yield('h2-title')</h2>
                
                @yield('article')
            </section>
        </main>

        <script src="/js/script.js"></script>

        <script src="https://kit.fontawesome.com/09a5251690.js" crossorigin="anonymous"></script>

        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    </body>

</html>
