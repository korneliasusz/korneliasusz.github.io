Vue.component('v-autocompleter', {

    data: function() {
        return {
            googleSearch: "",
            cities: window.cities,
            googleResults: false,
            autocompleterResults: true,
            current: -1,
            currentResults: -1,
            filteredCities_update: true,
        }
    },

    computed: {
        filteredCities: function() {
            let filtered = this.cities.filter(city => (city.name.includes(this.googleSearch) || city.name.toLowerCase().includes(this.googleSearch)));

            if (this.googleSearch == 0)
            {
                return null;
            } else 
            {
                return filtered.slice(0,10);
            }
        },

       
    },

    watch: {
        current: function() {
            //this.googleSearch = this.filteredCities[this.current].name;
            this.filteredCities_update = false;
        },

        googleSearch: function() {
            this.filteredCities_update = true;
        }
    },

    methods: {
        selectCity: function() {
            this.googleResults = true;
            this.filteredCities_update = true;
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
            if (this.current < this.filteredCities.length)
            {
                this.current++;
            } else if (this.current == this.filteredCities.length)
            {
                this.current = 0;
            }
        },

        up: function() {
            if(this.current > 0)
            {
                this.current--;
            } else if (this.current < 0)
            {
                this.current = this.filteredCities.length - 1;
            }
        },

        downResults: function() {
            if (this.currentResults < this.filteredCities.length)
            {
                this.currentResults++;
            } else if (this.currentResults == this.filteredCities.length)
            {
                this.currentResults = 0;
            }
        },

        upResults: function() {
            if(this.currentResults > 0)
            {
                this.currentResults--;
            } else if (this.currentResults < 0)
            {
                this.currentResults = this.filteredCities.length - 1;
            }
        },

        backResults: function() {
            this.autocompleterResults = false;
            this.currentResults = -1;
        }
    },

    props: ['options'],

    template: 
        <input 
            v-bind:options="options"
            v-on:input="$emit('input', $event.target.value)"
        />
    
    /*updated() {
        this.$nextTick(() => {
            this.$refs.inputFocus.focus();
        });
    }*/
})