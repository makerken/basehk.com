<div class="container">
    <div class="row mt-3">
        <div class="col d-flex flex-column">
            <div class="d-flex justify-content-between" style="z-index: 1">
                <input type="range" name="text_size" class="custom-range align-self-center" v-model.number="text_size" min="1" max="45" step="0.5">
                <button v-on:click="submit" class="btn align-self-end ml-3" :class="tab_submit ? 'btn-success' : 'btn-primary'">Set</button>
            </div>
        </div>
    </div>
</div>

@extends('words')
@section('word')
    @{{ sample }}
@endsection