@extends('layouts.app')

@section('content')
{{ $list }}
<div class="card">
    <div class="card-body">
        <h3 class="card-title">{{ $list->title }}<span> Play</span></h3>
        <ul>
            @foreach ($list->words as $word)
                <li>{{ $word }}</li> 
            @endforeach
        </ul>

        <a class="btn btn-secondary" href="/lists/{{ $list->id }}/edit" role="button">Edit</a>

        <form method="POST" action="/lists/{{ $list->id }}">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger">X</button>
            @include('errors')
        </form>

    </div>
</div>

@endsection