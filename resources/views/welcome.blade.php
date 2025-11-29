<!doctype html>
<html lang="es" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Alvaro Torres Fuchslocher">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="">
    <!-- Favicon -->
    <title>Floxtor SPA</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" defer>
    </script>
    <meta name="theme-color" content="#7952b3">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        /*
            * Globals
            */
        /* Custom default button */
        .btn-secondary,
        .btn-secondary:hover,
        .btn-secondary:focus {
            color: #333;
            text-shadow: none;
            /* Prevent inheritance from `body` */
        }

        /*
            * Base structure
            */
        body {
            text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
            box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
        }

        .cover-container {
            max-width: 42em;
        }

        /*
            * Header
            */
        .nav-masthead .nav-link {
            padding: .25rem 0;
            font-weight: 700;
            color: rgba(255, 255, 255, .5);
            background-color: transparent;
            border-bottom: .25rem solid transparent;
        }

        .nav-masthead .nav-link:hover,
        .nav-masthead .nav-link:focus {
            border-bottom-color: rgba(255, 255, 255, .25);
        }

        .nav-masthead .nav-link+.nav-link {
            margin-left: 1rem;
        }

        .nav-masthead .active {
            color: #fff;
            border-bottom-color: #fff;
        }
    </style>
    <!-- Custom styles for this template -->
    <!--link href="css/cover.css" rel="stylesheet"-->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
</head>

<body class="d-flex h-100 text-center text-white bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">floxtor.app</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link" aria-current="page" href="/admin">Ingresar</a>

                </nav>
            </div>
        </header>
        <main class="px-3">
            <!-- <h1>Floxtor</h1> -->
            <a href="https://www.floxtor.app">
                <img src="images/logo/white-logo-no-background.svg" width="200"alt="Logo">
            </a>

            <p class="lead">Desarrollo de sistemas</p>
            <p>
                <a href="https://api.whatsapp.com/send?phone=56982598059"
                    class="btn btn-lg btn-outline-secondary text-white">
                    <i class="bi-whatsapp"></i>
                </a>
                <a href="https://t.me/AquaroTorres" class="btn btn-lg btn-outline-secondary text-white">
                    <i class="bi-telegram"></i>
                </a>
                <a href="mailto:contacto@floxtor.app" class="btn btn-lg btn-outline-secondary text-white">
                    <i class="bi-envelope-at"></i>
                </a>
                <!-- <a href="https://twitter.com/aquarotorres" class="btn btn-lg btn-outline-secondary text-white">
                        <i class="bi-twitter"></i>
                    </a>
                    <a href="https://instagram.com/aquarotorres" class="btn btn-lg btn-outline-secondary text-white">
                        <i class="bi-instagram"></i>
                    </a>  -->
            </p>

            <!-- <p class="lead">
                    <a href="#" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Portafolio</a>
                </p> -->
        </main>
        <footer class="mt-auto text-white-50">
            <p>contacto@floxtor.app</p>
        </footer>
    </div>
</body>

</html>
