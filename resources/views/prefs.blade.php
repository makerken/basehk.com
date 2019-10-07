{{-- outline around pill block, vertical lines between pills --}}
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=ABeeZee|Amita|Andika|Be+Vietnam|Chilanka|Comfortaa|Convergence|Courgette|Delius|Delius+Swash+Caps|Didact+Gothic|Fredoka+One|Imprima|Inder|Kalam|Lexend+Deca|Lexend+Exa|Livvic|Mali|Manjari|Merienda+One|Mitr|Muli|Niramit|Pacifico|Poiret+One|Poppins|Quicksand|Rancho|Redressed|Ruluko|Secular+One|Shadows+Into+Light+Two|Sniglet|Sriracha&display=swap" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>basehk preferences</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app" :style="{backgroundColor: background_color }">
        <nav style="z-index: 1;" class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <form class="input-group col-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Text</div>
                    </div>
                    <input type="text" class="form-control" v-model="sample" name="sample" placeholder="Sample text">
                    <div class="input-group-append">
                        <button @click.prevent="sample_size -= 0.5" class="input-group-text plus">-</button>
                        <button @click.prevent="sample_size += 0.5" class="input-group-text plus">+</button>
                    </div>
                </form>

                <ul class="nav nav-pills pill-bg">
                    <li class="nav-item">
                        <div class="nav-link border-right" :class="{'badge-light':tab == 1}" v-on:click.stop="tab = 1" href="#">Playback</div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link border-right" :class="{'badge-light':tab == 2}" v-on:click.stop="tab = 2" href="#">Font</div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link border-right" :class="{'badge-light':tab == 3}" v-on:click.stop="tab = 3" href="#">Size</div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link border-right" :class="{'badge-light':tab == 4}" v-on:click.stop="tab = 4" href="#">Colors</div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link border-right" :class="{'badge-light':tab == 5}" v-on:click.stop="tab = 5" href="#">Position</div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link" :class="{'badge-light':tab == 6}" v-on:click.stop="tab = 6" href="#">Spacing</div>
                    </li>
                </ul>

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

        <template v-if="tab==1">
            @include('playback')
        </template>
        <template v-if="tab==2">
            @include('font')
        </template>
        <template v-if="tab==3">
            @include('size')
        </template>
        <template v-if="tab==4">
            @include('colors')
        </template>
        <template v-if="tab==5">
            @include('position')
        </template>
        <template v-if="tab==6">
            @include('spacing')
        </template>
        

    </div>

</body>
</html>
