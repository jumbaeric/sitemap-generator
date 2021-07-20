<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Free Google XML Sitemap Generator</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/cover/">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        div#loader {
            margin: 20px;
        }

        .download {
            margin-top: 20px;
        }

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

    </style>


    <!-- Custom styles for this template -->
    <link href="{{ asset('css/cover.css') }}" rel="stylesheet">
</head>

<body class="d-flex h-100 text-center text-white bg-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="mb-0 justify-content-center">Free Google XML Sitemap Generator</h3>
                {{-- <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    <a class="nav-link" href="#">Create</a>
                    <a class="nav-link" href="#">Contact</a>
                </nav> --}}
            </div>
        </header>

        <main class="px-3">
            <h1>Free Google XML Sitemap Generator</h1>
            <p class="lead">Just enter your website URL to create a free google xml sitemap.</p>
            <form action="/create" method="GET" id="my_form">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <input type="url" required name="url" class="form-control" placeholder="Your Website URL"
                            aria-label="Website URL">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-lg">Create</button>
                    </div>

                    <div class="col-12">
                        <!-- Image loader -->
                        <div id='loader' style='display: none;'>
                            <img src="{{ asset('images/loader.gif') }}" width='64px' height='64px'>
                            <div class="col-12">
                                <label id="minutes">00</label>:<label id="seconds">00</label>
                            </div>
                        </div>
                        <!-- Image loader -->
                    </div>

                    <div class="col-12 download" style='display: none;'>
                        <h3>Your Sitemap is Ready</h3>
                        <a href="" download="sitemap.xml">
                            <button type="button" class="btn btn-primary btn-lg">DOWNLOAD</button>
                        </a>
                    </div>
                </div>
            </form>

        </main>

        <footer class="mt-auto text-white-50">
            <p>Free Google XML Sitemap Generator by <a href="https://juliwebconsultancy.com" class="text-white">Juli Web
                    Consultancy</a>.</p>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('js/ajax.js') }}"></script>

</body>

</html>
