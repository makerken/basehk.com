@foreach ($lists as $list)
    <div class="col col-md-4 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between">
                    <p class="align-self-center h5 text-body">{{ $list->title }}</p>
                    {{-- <a href="/lists/{{ $list->id }}" v-on:click="play({{ $list->id }})" class="align-self-center h5 text-body">{{ $list->title }}</a> --}}
                    <a href="/lists/{{ $list->id }}" v-on:click="play({{ $list->id }})" class="btn btn-success align-self-end" role="button">&#9658;</a>
                </div>
                @php
                    $words = json_decode($list->words);
                @endphp
                @foreach ($words as $word)
                    {{ $word }}</br>
                @endforeach

                <form method="POST" action="/lists/{{ $list->id }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn text-danger float-right mr-1">X</button>
                    @include('errors')
                </form>
            </div>
        </div>
    </div>
@endforeach