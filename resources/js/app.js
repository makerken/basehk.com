/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    created: function() {
        this.update();
        window.addEventListener('keydown', function(e) {
            urlPath = window.location.pathname.split('/');
            if( urlPath[2] ) {
                if(e.keyCode == (8 || 12)) {    // delete || backspace
                    e.preventDefault();
                }
                if(e.keyCode == 72) {           // h
                    this.homeNav();
                }
            }
            if( urlPath[2] ) {
                if(e.keyCode == (8 || 12)) {    // delete || backspace
                    e.preventDefault();
                }
            }
            switch (e.keyCode) {
                case 16:    // shift
                case 18:    // opt
                case 224:   // cmd
                    break;
                case 13:    // enter
                case 80:    // p
                case 65:    // a
                    this.togglePlay();
                    break;
                case 8:     // delete
                case 12:    // backspace
                case 37:    // left arrow
                    this.previous();
                    break;
                case 27:    // esc
                    this.homeNav();
                    break;
                case 70:	// f
                    // toggleFullscreen();
                    // break;
                default:
                    this.next();                    
                    break;
            }
        }.bind(this));
    },
    data: function() {
        return {
            active_list_num: 0,
            auto_time: 1500,
            autoadvance: true,
            autoTimerId: 0,
            background_color: '#040022',
            font: "'Didact Gothic', sans-serif;",
            hue: 0,
            letter_spacing: 0.0,
            lightness: 0,
            num_color: 18,
            position_x: 0,
            position_y: 40,
            sample: 'Gagek',
            sample_size: 4, 
            shuffle: true,
            tab: 1,
            tab_submit: false,
            textBgSet: 0,
            text_color: '#eeddff',
            text_size: 15,
            words: '…',
            word_num: 0
        }
    },
    computed: {
        fontInline: function() {
            return this.font.slice(0,-1);
        }
    },
    methods: {
        homeNav() {
            window.location.href = '/';
        },
        setFont(fontname) {
            this.font = fontname;
            this.submit();
        },
        submit() {
            this.tab_submit = true;
            axios.post('/preferences', {
                autoadvance:        this.autoadvance,
                auto_time:          this.auto_time,
                background_color:   this.background_color,
                font:               this.font,
                letter_spacing:     this.letter_spacing,
                position_y:         this.position_y,
                sample:             this.sample,
                sample_size:        this.sample_size,
                shuffle:            this.shuffle,
                text_color:         this.text_color,
                text_size:          this.text_size,
            })
            .then(response => {
                this.nextTab();
                this.autoadvance =      response.data.autoadvance,
                this.auto_time =        response.data.auto_time,
                this.background_color = response.data.background_color;
                this.font =             response.data.font;
                this.letter_spacing =   response.data.letter_spacing;
                this.position_y =       response.data.position_y;
                this.sample =           response.data.sample;
                this.sample_size =      response.data.sample_size;
                this.shuffle =          response.data.shuffle,
                this.text_color =       response.data.text_color;
                this.text_size =        response.data.text_size;
            })
            .catch(error =>  {
                // console.log('error', error);
            });
        },
        update() {
            axios.post('/preferences', {})
            .then(response => {
                for (let [key, value] of Object.entries(response.data)) {
                    if (value) {
                        if(key == 'words') {
                            this[key] = JSON.parse(value);
                            this.randomize();
                        } else {
                            this[key] = value;
                        }
                    }
                }
            })
            .catch(error =>  {
                // console.log('error', error);
            });
        },
        randomize() {
            var currentIndex = this.words.length, temporaryValue, randomIndex;
            while (0 !== currentIndex) {
                // Pick a remaining element...
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex -= 1;
        
                // And swap it with the current element.
                temporaryValue = this.words[currentIndex];
                this.words[currentIndex] = this.words[randomIndex];
                this.words[randomIndex] = temporaryValue;
            }
        },
        previous() {
            clearTimeout(this.autoTimerId);
            if( this.word_num != 0 ) {
                this.word_num -= 1;
                this.autoAdvance();
            }
        },
        next() {
            clearTimeout(this.autoTimerId);
            if( this.word_num < this.words.length - 1 ) {
                this.autoAdvance();
            }
            if( this.word_num == this.words.length - 1 ) {
                if(this.shuffle) {
                    this.randomize();
                }
                this.word_num = 0;
                this.autoAdvance();
            } else {
                this.word_num += 1;
            } 
        },
        togglePlay() {
            this.tab_submit = true;
            setTimeout(() => { 
                this.tab_submit = false;
            }, 1000);

            if( this.autoadvance ) {
                this.autoadvance = false;
            } else {
                this.autoadvance = true;
            }
        },
        autoAdvance() {
            if( this.autoadvance == true ) {
                this.autoTimerId = setTimeout(() => { 
                    if(this.word_num < this.words.length - 1 ) {
                        this.next(); 
                    }
                }, this.auto_time);
            }
        },
        nextTab() {
            setTimeout(() => {
                this.tab += 1;
                this.tab_submit = false;
                if(this.tab > 6) {
                    this.homeNav();
                    this.tab_submit = false;
                }
            }, 400);
        },
        incrementH( value, c = 0 ) {
            boxes = 360 / this.num_color;
            value = value * boxes - boxes;
            if( c ) { return value };
            hslArray = [value, 100, 50];
            return 'hsl('+ hslArray[0] +','+ hslArray[1] +'%,'+ hslArray[2] +'%)';
        },
        incrementL( value, c = 0 ) {
            boxes = 100 / (this.num_color-1);
            value = value * boxes - boxes;
            if( c ) { return value };
            hslArray = [this.hue, 100, value];
            return 'hsl('+ hslArray[0] +','+ hslArray[1] +'%,'+ hslArray[2] +'%)';
        },
        setH( value ) {
            this.lightness = 0;
            this.hue = this.incrementH( value, 1 );
        },
        /**
         * Converts an HSL color value to RGB. Conversion formula
         * adapted from http://en.wikipedia.org/wiki/HSL_color_space.
         * https://gist.github.com/mjackson/5311256
         * Assumes h, s, and l are contained in the set [0, 1] and
         * returns r, g, and b in the set [0, 255].
         *
         * @param   Number  h       The hue
         * @param   Number  s       The saturation
         * @param   Number  l       The lightness
         * @return  Array           The RGB representation
         */
        hslToRgb(h, s, l) {
            var r, g, b;
        
            if (s == 0) {
                r = g = b = l; // achromatic
            } else {
                function hue2rgb(p, q, t) {
                    if (t < 0) t += 1;
                    if (t > 1) t -= 1;
                    if (t < 1/6) return p + (q - p) * 6 * t;
                    if (t < 1/2) return q;
                    if (t < 2/3) return p + (q - p) * (2/3 - t) * 6;
                    return p;
                }
            
                var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
                var p = 2 * l - q;
            
                r = hue2rgb(p, q, h + 1/3);
                g = hue2rgb(p, q, h);
                b = hue2rgb(p, q, h - 1/3);
            }
        
            return [ r * 255, g * 255, b * 255 ];
        },
        setColor( value ) {
            this.lightness = value;
            var rgb = this.hslToRgb(this.hue/360, 1, this.incrementL(value, 1)/100);
            var rgbString = '#' + (( Math.round(rgb[0]) << 16 ) + ( Math.round(rgb[1]) << 8) + Math.round(rgb[2]) ).toString(16).padStart(6, "0");

            if( !this.textBgSet ) {
                this.text_color = rgbString.slice(0,7);
            } else {
                this.background_color = rgbString.slice(0,7);
            }
        }
    }
});