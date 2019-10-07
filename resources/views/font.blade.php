<div class="container">
    <div class="row">
        @foreach ($fonts as $font)
        <div class="col col-md-4 col-lg-3 p-3">
            <div class="d-flex flex-column border-bottom">
                <p :style="{color: text_color, fontSize: sample_size + 'em', letterSpacing: letter_spacing + 'em' }" style="font-family: {{ $font }};">@{{ sample}}</p>
                <div class="d-flex justify-content-between">
                    @php
                        preg_match('/[^\']+/', $font, $matches);
                        $uri = preg_replace('/\s/','+',$matches[0]);
                        echo('<a class="text-muted align-self-center" href="https://fonts.google.com/specimen/' . $uri . '">' . $matches[0] . '</a>');
                    @endphp
                    <button v-on:click="setFont(`{{ $font }}`)" class="btn btn-sm align-self-end mb-1" :class="font == `{{ $font }}` ? 'btn-success' : 'btn-primary'">Set</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>