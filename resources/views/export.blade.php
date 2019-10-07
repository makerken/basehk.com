{{-- outline around pill block, vertical lines between pills --}}
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>export</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <a class="btn btn-primary mr-3" href="/" role="button">Lists</a>                        

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <p>Copy-paste the CSV below and save it</p>
            @php
                for ($i=0; $i < count($lists); $i++) { 
                    echo($lists[$i]['title'] . '</br>');
                    $words = json_decode($lists[$i]['words']);
                    for ($j=0; $j < count($words)-1; $j++) { 
                        echo($words[$j] . ',');
                    }
                    echo($words[count($words)-1] . '</br>');
                }
            @endphp
        </div>
    </div>

</body>
</html>


