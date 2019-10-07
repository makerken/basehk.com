<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Words</title>
    <link href="https://fonts.googleapis.com/css?family={{$fonturi ?? 'Imprima'}}&display=swap" rel="stylesheet"> 
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
    <body>
        <div id="app" :style="{backgroundColor: background_color}" v-on:click="next">
            <div> 
                @extends('words')
                @section('word')
                    @{{ words[word_num] }}
                @endsection
        </div>

        <div class="homenav" v-on:click.stop="homeNav">
            <svg width="40" height="40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <defs>
                    <mask id="back-arrow">
                        <circle cx="20" cy="20" r="20" fill="white" opacity="0.5"/>
                        <path d="M 25 10 L 10 20 L 25 30" stroke-width="5" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke="black"/>
                    </mask>
                </defs>
                <circle cx="20" cy="20" r="20" fill="{{ $text_color }}" mask="url(#back-arrow)"/>
            </svg>
        </div>

        <div class="play-info">
            <p :class="tab_submit ? 'fade-alert' : 'd-none'" :style="{ color: text_color }" >Autoplay @{{ autoadvance ? 'on' : 'off' }}</p>
        </div>

        <div v-if="word_num == 0" class="word-num">
            <svg width="40" height="40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <defs>
                    <mask id="first-arrow">
                        <circle cx="20" cy="20" r="20" fill="white" opacity="0.5"/>
                        <path d="M 20 26 L 15 20 L 20 14" stroke-width="4" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke="black"/>
                        <path d="M 30 20 L 15 20" stroke-width="4" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke="black"/>
                        <path d="M 10 10 L 10 30" stroke-width="4" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke="black"/>
                    </mask>
                </defs>
                <circle cx="20" cy="20" r="20" fill="{{ $text_color }}" mask="url(#first-arrow)"/>
            </svg>
        </div>
        <div v-if="word_num == words.length-1" class="word-num">
            <svg width="40" height="40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <defs>
                    <mask id="last-arrow">
                        <circle cx="20" cy="20" r="20" fill="white" opacity="0.5"/>
                        <path d="M 20 14 L 25 20 L 20 26" stroke-width="4" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke="black"/>
                        <path d="M 10 20 L 25 20" stroke-width="4" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke="black"/>
                        <path d="M 30 10 L 30 30" stroke-width="4" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke="black"/>
                    </mask>
                </defs>
                <circle cx="20" cy="20" r="20" fill="{{ $text_color }}" mask="url(#last-arrow)"/>
            </svg>
        </div>


        

    </body>
</html>