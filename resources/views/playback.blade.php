<div class="container">
    <div class="row mt-3">
        <form @submit.prevent="submit" class="col d-flex flex-column">
            <div class="d-flex justify-content-between" style="z-index: 1">
                <div class="btn-group" role="group">
                    <div class="form-check btn btn-light pl-45">
                        <input class="form-check-input" type="checkbox" v-model="shuffle" true-value="true" false-value="false" id="shuffle">
                        <label class="form-check-label" for="shuffle">
                            Shuffle
                        </label>
                    </div>
    
                    <div class="form-check btn btn-light pl-45 border-left">
                        <input class="form-check-input" type="checkbox" v-model="autoadvance" true-value="true" false-value="false" id="autoadvance">
                        <label class="form-check-label" for="autoadvance">
                            Autoadvance
                        </label>
                    </div>
                </div>

                <input type="range" class="custom-range align-self-center ml-3" v-model.number="auto_time" min="500" max="5000" step="100">
                <div class="btn-group" role="group">
                    <button disabled class="btn btn-light ml-3">@{{ auto_time / 1000 }}&nbsp;sec</button>
                    <button type="submit" class="btn align-self-end" :class="tab_submit ? 'btn-success' : 'btn-primary'">Set</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row mt-3">
        <div class="col" style="z-index: 1">
            <div class="alert alert-light alert-dismissible fade show" role="alert">
                <p><strong>Preview timing:</strong> Make and play a list and it will show below, you can click on the word or press a key to preview it below.</p>
                <p class="mb-0"><strong>When playing:</strong> p and enter temporarily toggle autoplay, backspace and left arrow go back</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="words" v-on:click="next" :style="{top: position_y + '%', fontFamily: fontInline, fontSize: text_size + 'em', color: text_color, letterSpacing: letter_spacing + 'em'}">
    @{{ words[word_num] }}
</div>