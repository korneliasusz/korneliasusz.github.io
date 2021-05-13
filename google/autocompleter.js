Vue.component('v-autocompleter', {

    data: function() {
        return {
            googleSearch: "",
            cities: window.cities,
            //googleResults: false,
            autocompleterResults: true,
            current: -1,
            currentResults: -1,
            filteredCities: [],
            autocompleterIsActive: false,
        }
    },

    watch: {
        googleSearch: function() {
            if (this.autocompleterIsActive)
            {
                return;
            }

            let filtered = this.cities.filter(city => (city.name.includes(this.googleSearch) || city.name.toLowerCase().includes(this.googleSearch)));

            if (this.googleSearch === 0)
            {
                filteredCities = [];
                return;
            } else 
            {
                this.filteredCities = filtered.slice(0,10);
            }
        }
    },

    methods: {
        selectCity: function() {
            //this.googleResults = true;
            //this.googleSearch = this.filteredCities[current].name;
            //this.googleSearch=city.name
            console.log('dziala');
            console.log(this.googleResults);
        },

        highlight: function(word, query) {
            return result = word.replace(query, '<span class="nonhighlighted">' + query + '</span>')
        },

        selectCityResults: function() {
            this.autocompleterResults = false;
        },

        selectCityResults2: function() {
            this.autocompleterResults = true;
        },

        down: function() {
            if (!this.autocompleterIsActive) {
                this.current = -1;
            }
            if (this.current < this.filteredCities.length)
            {
                this.current++;
            } else if (this.current == this.filteredCities.length)
            {
                this.current = 0;
            }
            this.autocompleterIsActive = true;
            this.googleSearch = this.filteredCities[this.current].name;

        },

        up: function() {
            if (!this.autocompleterIsActive) {
                this.current = -1;
            }
            if(this.current > 0)
            {
                this.current--;
            } else if (this.current < 0)
            {
                this.current = this.filteredCities.length - 1;
            }
            this.autocompleterIsActive = true;
            this.googleSearch = this.filteredCities[this.current].name;
        },

        back: function() {
            this.autocompleterIsActive = false;
            this.current = -1;
        },

        downResults: function() {
            if (!this.autocompleterIsActive) {
                this.currentResults = -1;
            }
            if (this.currentResults < this.filteredCities.length)
            {
                this.currentResults++;
            } else if (this.currentResults == this.filteredCities.length)
            {
                this.currentResults = 0;
            }
            this.autocompleterIsActive = true;
            this.googleSearch = this.filteredCities[this.currentResults].name;
        },

        upResults: function() {
            if (!this.autocompleterIsActive) {
                this.currentResults = -1;
            }
            if(this.currentResults > 0)
            {
                this.currentResults--;
            } else if (this.currentResults < 0)
            {
                this.currentResults = this.filteredCities.length - 1;
            }
            this.autocompleterIsActive = true;
            this.googleSearch = this.filteredCities[this.currentResults].name;
        },

        backResults: function() {
            this.autocompleterResults = false;
            this.autocompleterIsActive = false;
            this.currentResults = -1;
        },
    },

    props: ['options'],

    template: 
        //'<div class="search_area"><div class="search_area2"><div class="search_icon"><img class="search_icon2" src="search.png"></div><div class="text_area1"><div class="text_area2"><input v-model="googleSearch" ref="inputFocus" class="text_input" maxlength="2048" name="q" type="text" aria-autocomplete="both" aria-haspopup="false" autocapitalize="off" autocomplete="off" autocorrect="off" autofocus role="combobox" spellcheck="false" title="Szukaj" value aria-label="Szukaj" v-on:keyup.enter="selectCity(), googleSearch=filteredCities[current].name" v-on:keyup.down="down()" v-on:keyup.up="up()" v-on:keyup.delete="back()"/></div></div><div class="key_area"><img src="tia.png"></div><div class="mic_area"><img src="mic.png"></div></div></div><ul :class="{nothing: googleSearch.length == 0, autocompleter: googleSearch.length > 0}"><li class="element"  :class="{hovered: current == i}" v-for="(city, i) in filteredCities" v-on:click="googleSearch=city.name; selectCity()"><img src="search.png"><span class="highlighted" v-html="highlight(city.name, googleSearch)">{{ city.name }}</span></li></ul>'
    `
        <div class="search_section">
            <div class="search_area">
                <div class="search_area2">
                    <div class="search_icon">
                        <img class="search_icon2" src="search.png">
                    </div>                  
                    <div class="text_area1">
                        <div class="text_area2">
                            <input v-model="googleSearch" ref="inputFocus" class="text_input" maxlength="2048" name="q" type="text" aria-autocomplete="both" aria-haspopup="false" autocapitalize="off" autocomplete="off" autocorrect="off" autofocus role="combobox" spellcheck="false" title="Szukaj" value aria-label="Szukaj"
                                v-on:keyup.enter="googleSearch=filteredCities[current].name, $emit('enter')"
                                v-on:keyup.down="down()"
                                v-on:keyup.up="up()"
                                v-on:keyup.delete="back()"                       
                            />
                        </div>
                    </div>                    
                    <div class="key_area">
                        <img src="tia.png">
                    </div>
                    <div class="mic_area">
                        <img src="mic.png">
                    </div>
                </div>
            </div>
            <ul :class="{nothing: googleSearch.length === 0, autocompleter: googleSearch.length > 0}">
                <li class="element"  :class="{hovered: current === i}" v-for="(city, i) in filteredCities" v-on:click="googleSearch=city.name, $emit('enter')">
                    <img src="search.png">
                    <span class="highlighted" v-html="highlight(city.name, googleSearch)">{{ city.name }}</span>
                </li>
            </ul>
        </div>
    `
})


Vue.component('v-autocompleter-results', {

    data: function() {
        return {
            googleSearch: "",
            cities: window.cities,
            googleResults: false,
            autocompleterResults: true,
            current: -1,
            currentResults: -1,
            filteredCities: [],
            autocompleterIsActive: false,
        }
    },

    watch: {
        googleSearch: function() {
            if (this.autocompleterIsActive)
            {
                return;
            }

            let filtered = this.cities.filter(city => (city.name.includes(this.googleSearch) || city.name.toLowerCase().includes(this.googleSearch)));

            if (this.googleSearch === 0)
            {
                filteredCities = [];
                return;
            } else 
            {
                this.filteredCities = filtered.slice(0,10);
            }
        }
    },

    methods: {
        selectcity: function() {
            this.googleResults = true;
            this.googleSearch = this.filteredCities[current].name;
        },

        highlight: function(word, query) {
            return result = word.replace(query, '<span class="nonhighlighted">' + query + '</span>')
        },

        selectCityResults: function() {
            this.autocompleterResults = false;
        },

        selectCityResults2: function() {
            this.autocompleterResults = true;
        },

        down: function() {
            if (!this.autocompleterIsActive) {
                this.current = -1;
            }
            if (this.current < this.filteredCities.length)
            {
                this.current++;
            } else if (this.current == this.filteredCities.length)
            {
                this.current = 0;
            }
            this.autocompleterIsActive = true;
            this.googleSearch = this.filteredCities[this.current].name;

        },

        up: function() {
            if (!this.autocompleterIsActive) {
                this.current = -1;
            }
            if(this.current > 0)
            {
                this.current--;
            } else if (this.current < 0)
            {
                this.current = this.filteredCities.length - 1;
            }
            this.autocompleterIsActive = true;
            this.googleSearch = this.filteredCities[this.current].name;
        },

        back: function() {
            this.autocompleterIsActive = false;
            this.current = -1;
        },

        downResults: function() {
            if (!this.autocompleterIsActive) {
                this.currentResults = -1;
            }
            if (this.currentResults < this.filteredCities.length)
            {
                this.currentResults++;
            } else if (this.currentResults == this.filteredCities.length)
            {
                this.currentResults = 0;
            }
            this.autocompleterIsActive = true;
            this.googleSearch = this.filteredCities[this.currentResults].name;
        },

        upResults: function() {
            if (!this.autocompleterIsActive) {
                this.currentResults = -1;
            }
            if(this.currentResults > 0)
            {
                this.currentResults--;
            } else if (this.currentResults < 0)
            {
                this.currentResults = this.filteredCities.length - 1;
            }
            this.autocompleterIsActive = true;
            this.googleSearch = this.filteredCities[this.currentResults].name;
        },

        backResults: function() {
            this.autocompleterResults = false;
            this.autocompleterIsActive = false;
            this.currentResults = -1;
        }
    },

    props: ['options'],

    template:
    `
            <div class="topbar">
                    <img class="logo_img" src="logo.png">
                    <div class="searchbar">
                        <input v-model="googleSearch" ref="inputFocus" class="search_text" type="text" v-on:click="selectCityResults()"
                        v-on:keyup.enter="selectCityResults2(), googleSearch=filteredCities[currentResults].name"
                        v-on:keyup.down="downResults()"
                        v-on:keyup.up="upResults()" 
                        v-on:keyup.delete="backResults()"                       
                        />
                        <img class="key_img" src="keyboard.PNG">
                        <img class="mic_img" src="mic.png">
                        <img class="search_img" src="search.png">
                    </div>
                    <ul :class="{nothing: autocompleterResults == true || googleSearch.length == 0, autocompleter: autocompleterResults == false}">
                        <li class="element" :class="{hovered: currentResults == i}" v-for="(city, i) in filteredCities" v-on:click="googleSearch=city.name; selectCityResults2()">
                            <img src="search.png">
                            <span class="highlighted" v-html="highlight(city.name, googleSearch)">{{ city.name }}</span>
                        </li>
                    </ul>
                    <img class="menu" src="bars.png">
                    <button class="log_button">Zaloguj się</button>
                </div>
            </div>
    `
})