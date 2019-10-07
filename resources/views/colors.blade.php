<div class="container">
    <div class="row mt-3">
        <div class="col-sm-auto" style="z-index: 1">
            <ul class="nav nav-pills flex-column pill-bg">
                <li class="nav-item">
                    <div class="nav-link" :class="{'badge-light': !textBgSet }" v-on:click="textBgSet = 0">Text Color</div>
                </li>
                <li class="nav-item">
                    <div class="nav-link" :class="{'badge-light': textBgSet }" v-on:click="textBgSet = 1">Background</div>
                </li>
            </ul>
        </div>

        <div class="col" style="z-index: 1">
            <div class="d-flex flex-row justify-content-right">
                <div v-for="s in num_color">
                    <div class="picker d-flex" :style="{ 'background-color': incrementH(s) }" v-on:click="setH(s)">
                        <div v-if="s == hue/num_color+1" class="pick-indicator mt-auto mx-auto"></div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-right">
                <div v-for="j in num_color">
                    <div class="picker d-flex" :style="{ 'background-color': incrementL(j) }" v-on:click="setColor(j)">
                        <div :class="{'pick-indicator mt-auto mx-auto': j == lightness }" :style="[ j<6 ? {'border-bottom': '8px solid var(--light)'} : {} ]"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-auto" style="z-index: 1">
            <button v-on:click="submit" type="submit" class="btn ml-3" :class="tab_submit ? 'btn-success' : 'btn-primary'">Set</button>
        </div>
    </div>
</div>

@extends('words')
@section('word')
    @{{ sample }}
@endsection