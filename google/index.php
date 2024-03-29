<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="origin" name="referrer">
    <link rel="shortcut icon" href="icon.png">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="search_style.css">
    <link rel="stylesheet" href="autocompleter.css">
    <title>Google</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <!-- <script src="cities.js"></script> -->
    <!-- <script src="autocompleter.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js" integrity="sha512-JZSo0h5TONFYmyLMqp8k4oPhuo6yNk9mHM+FY50aBjpypfofqtEWsAgRDQm94ImLCzSaHeqNvYuD9382CEn2zw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>  <!--W celu wyswietlenia strony glownej class="home", w celu wyswietlenia strony z wynikami class="results"-->
    <!--Strona glowna-->
    <div id="app" :class="{home: googleResults === false, results: googleResults === true}" > <!--:class="{home: googleSearch.length == 0, results: googleSearch.length > 0}" lub :class="googleSearch.length == 0 ? 'home' : 'results'"-->
        <div id="home_page">
        <div class="body">
            <div class="header">
                <div class="header2">
                    <div class="top_items">
                        <div class="top_items2">
                            <div class="item1">
                                <a class="item1_det" data-pid="23" href="https://www.google.com/intl/pl/gmail/about/#" target="_top">Gmail</a>
                            </div>
                            <div class="item1">
                                <a class="item1_det" data-pid="2" href="https://www.google.pl/imghp?hl=pl&ogbl" target="_top">Grafika</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="top_items3">
                    <div class="menu">
                        <div class="menu_det">
                            <div class="menu_det2">
                                <a class="menu_apps" aria-label="Aplikacje Google" href="" aria-expanded="false" role="button" tabindex="0"><img src="bars.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="top_items4" href="" target="_top">Zaloguj się</a>
            </div>
        </div>
        <div class="logo_section">
            <div class="logo_section2">
                <img class="logo" alt="Google" height="92" src="logo.png" width="272">
            </div>
        </div>
        
        <div class="search_section">
            <div class="search_area">
                <div class="search_area2">
                    <div class="search_icon">
                        <img class="search_icon2" src="search.png">
                    </div>                  
                    <div class="text_area1">
                        <div class="text_area2">
                            <input @input="findResultsDebounced" v-model="googleSearch" ref="inputFocus" class="text_input" maxlength="2048" name="q" type="text" aria-autocomplete="both" aria-haspopup="false" autocapitalize="off" autocomplete="off" autocorrect="off" autofocus role="combobox" spellcheck="false" title="Szukaj" value aria-label="Szukaj"
                                v-on:keyup.enter="showResults(), googleSearch=results[current].name"
                                v-on:keyup.down="down()"
                                v-on:keyup.up="up()"                    
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
            <ul :class="{nothing: googleSearch.length == 0, autocompleter: googleSearch.length > 0}">
                <li class="element"  :class="{hovered: current == i}" v-for="(city, i) in results" v-on:click="googleSearch=city.name, showResults2()">
                    <img src="search.png">
                    <span class="highlighted" v-html="highlight(city.name, googleSearch)">{{ city.name }}</span>
                </li>
            </ul>
        </div>

        <!-- <v-autocompleter v-model="googleSearch" @input="googleSearch = $event" v-on:enter="showResults"></v-autocompleter> -->

        <div class="buttons_area">
            <input class="button_search" type="submit" value="Szukaj w Google">
            <input class="button_search" type="submit" value="Szczęśliwy traf">
        </div>

        <div class="null"></div>

        <div class="bottom_section">
            <div class="bottom_section1">
                Polska
            </div>

            <div class="bottom_section2">
                <div class="bottom_elements1">
                    <a class="bottom_item" href="https://about.google/?utm_source=google-PL&utm_medium=referral&utm_campaign=hp-footer&fg=1">O nas</a>
                    <a class="bottom_item" href="https://ads.google.com/intl/pl_pl/home/?subid=ww-ww-et-g-awa-a-g_hpafoot1_1!o2&utm_source=google.com&utm_medium=referral&utm_campaign=google_hpafooter&fg=1">Reklamuj się</a>
                    <a class="bottom_item" href="https://www.google.com/services/?subid=ww-ww-et-g-awa-a-g_hpbfoot1_1!o2&utm_source=google.com&utm_medium=referral&utm_campaign=google_hpbfooter&fg=1#?modal_active=none">Dla firm</a>
                    <a class="bottom_item" href="https://www.google.com/search/howsearchworks/?fg=1">Jak działa wyszukiwarka</a>
                </div>
                <div class="bottom_elements2">
                    <img src="leaf.png">
                    <a class="bottom_item" href="https://sustainability.google/intl/pl/commitments-europe/?utm_source=googlehpfooter&utm_medium=housepromos&utm_campaign=bottom-footer&utm_content=">Neutralność węglowa od 2007 roku</a>
                </div>
                <div class="bottom_elements3">
                    <a class="bottom_item" href="https://policies.google.com/privacy?hl=pl&fg=1">Prywatność</a>
                    <a class="bottom_item" href="https://policies.google.com/terms?hl=pl&fg=1">Warunki</a>
                    <a class="bottom_item" href="#">Ustawienia</a>
                </div>
            </div>
        </div>
        </div>

     <!--Strona wyszukiwania-->
        <div id="results_page">
            <div id="header">
                <div class="topbar">
                    <img class="logo_img" src="logo.png">
                    <div class="searchbar">
                        <input @input="findResultsDebounced" v-model="googleSearch" ref="inputFocus" class="search_text" type="text" v-on:click="autocompleterResults=false"
                        v-on:keyup.enter="showResults(), googleSearch=results[currentResults].name, autocompleterResults=true"
                        v-on:keyup.down="downResults()"
                        v-on:keyup.up="upResults()" 
                        v-on:keyup.delete="backResults()"                       
                        />
                        <img class="key_img" src="keyboard.PNG">
                        <img class="mic_img" src="mic.png">
                        <img class="search_img" src="search.png">
                    </div>
                    <ul :class="{nothing: autocompleterResults == true || googleSearch.length == 0, autocompleter: autocompleterResults == false}">
                        <li class="element" :class="{hovered: currentResults == i}" v-for="(city, i) in results" v-on:click="googleSearch=city.name, showResults2(), autocompleterResults=true">
                            <img src="search.png">
                            <span class="highlighted" v-html="highlight(city.name, googleSearch)">{{ city.name }}</span>
                        </li>
                    </ul>
                    <img class="menu" src="bars.png">
                    <button class="log_button">Zaloguj się</button>
                </div>
            </div>
            
    
            
            <!-- <v-autocompleter-results v-model="googleSearch" @input="googleSearch = $event"></v-autocompleter-results> -->

            <div class="options">
                <ul class="options1">
                    <span class="pic"><svg focusable="false" viewBox="0 0 24 24"><path fill="#34a853" d="M10 2v2a6 6 0 0 1 6 6h2a8 8 0 0 0-8-8"></path><path fill="#ea4335" d="M10 4V2a8 8 0 0 0-8 8h2c0-3.3 2.7-6 6-6"></path><path fill="#fbbc04" d="M4 10H2a8 8 0 0 0 8 8v-2c-3.3 0-6-2.69-6-6"></path><path fill="#4285f4" d="M22 20.59l-5.69-5.69A7.96 7.96 0 0 0 18 10h-2a6 6 0 0 1-6 6v2c1.85 0 3.52-.64 4.88-1.68l5.69 5.69L22 20.59"></path></svg></span>
                    <li class="active_option">Wszystko</li>
                    <span class="pic"><svg focusable="false" viewBox="0 0 24 24"><path d="M14 13l4 5H6l4-4 1.79 1.78L14 13zm-6.01-2.99A2 2 0 0 0 8 6a2 2 0 0 0-.01 4.01zM22 5v14a3 3 0 0 1-3 2.99H5c-1.64 0-3-1.36-3-3V5c0-1.64 1.36-3 3-3h14c1.65 0 3 1.36 3 3zm-2.01 0a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h7v-.01h7a1 1 0 0 0 1-1V5"></path></svg></span>
                    <li>Grafika</li>
                    <span class="pic"><svg focusable="false" viewBox="0 0 24 24"><path d="M12 11h6v2h-6v-2zm-6 6h12v-2H6v2zm0-4h4V7H6v6zm16-7.22v12.44c0 1.54-1.34 2.78-3 2.78H5c-1.64 0-3-1.25-3-2.78V5.78C2 4.26 3.36 3 5 3h14c1.64 0 3 1.25 3 2.78zM19.99 12V5.78c0-.42-.46-.78-1-.78H5c-.54 0-1 .36-1 .78v12.44c0 .42.46.78 1 .78h14c.54 0 1-.36 1-.78V12zM12 9h6V7h-6v2"></path></svg></span>
                    <li>Wiadomości</li>
                    <span class="pic"><svg focusable="false" viewBox="0 0 24 24"><path d="M10 16.5l6-4.5-6-4.5v9zM5 20h14a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1zm14.5 2H5a3 3 0 0 1-3-3V4.4A2.4 2.4 0 0 1 4.4 2h15.2A2.4 2.4 0 0 1 22 4.4v15.1a2.5 2.5 0 0 1-2.5 2.5"></path></svg></span>
                    <li>Wideo</li>
                    <span class="pic"><svg focusable="false" viewBox="0 0 16 16"><path d="M7.503 0c3.09 0 5.502 2.487 5.502 5.427 0 2.337-1.13 3.694-2.26 5.05-.454.528-.906 1.13-1.358 1.734-.452.603-.754 1.508-.98 1.96-.226.452-.377.829-.904.829-.528 0-.678-.377-.905-.83-.226-.451-.527-1.356-.98-1.959-.452-.603-.904-1.206-1.356-1.734C3.132 9.121 2 7.764 2 5.427 2 2.487 4.412 0 7.503 0zm0 1.364c-2.283 0-4.14 1.822-4.14 4.063 0 1.843.86 2.873 1.946 4.177.468.547.942 1.178 1.4 1.79.34.452.596.99.794 1.444.198-.455.453-.992.793-1.445.459-.61.931-1.242 1.413-1.803 1.074-1.29 1.933-2.32 1.933-4.163 0-2.24-1.858-4.063-4.139-4.063zm0 2.734a1.33 1.33 0 11-.001 2.658 1.33 1.33 0 010-2.658"></path></svg></span>
                    <li>Mapy</li>
                    <span class="pic2"><svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path></svg></span>
                    <li>Więcej</li>
                    <li>Ustawienia</li>
                    <li>Narzędzia</li>
                </ul>
            </div>
            <div class="results_area">
                <!--<p>Miasta zawierające frazę <i>{{ googleSearch }}</i>:</p>
                <ul>
                    <li v-for="city in filteredCities">
                        {{ city.name }}
                    </li>
                </ul>-->
                <p class="results_number">Około 40 500 000 wyników (0,74 s)</p>
                <div class="search_result">
                    <a href=" " >
                        <p class="upper_info">context.reverso.net <span class="upper_info2">> tłumaczenie > polski-angielski > jakaś+inf... ▼</span></p>
                        <h3>jakaś informacja - Tłumaczenie na angielski - polskich ...</h3>
                    </a>
                    <p class="details">Dobrze, ale jeśli będzie u was <b>jakaś informacja</b>, ja podjadę jeszcze. If you'll have any info, I'll be back. Sure, come back.
                    </p>
                </div>
                <div class="search_result">
                    <a href=" " >
                        <p class="upper_info">context.reverso.net <span class="upper_info2">> tłumaczenie > polski-angielski > jakaś+inf... ▼</span></p>
                        <h3>jakaś informacja, - Tłumaczenie na angielski - polskich ...</h3>
                    </a>
                    <p class="details">Tłumaczenia w kontekście hasła "<b>jakaś informacja</b>," z polskiego na angielski od Reverso Context: Jeśli coś masz, jakaś informacja, która mogłaby pomóc...</p>
                </div>
                <div class="search_result">
                    <a href=" " >
                        <p class="upper_info">https://www.krolewska-akademia.pl <span class="upper_info2">> tekst-pierwszy ▼</span></p>
                        <h3>Jakaś informacja 1 | Królewska Akademia Biznesu i Dyplomacji</h3>
                    </a>
                    <p class="details"><b>Jakaś informacja</b> 1. 10 czerwca 2015 • Under: Bez kategorii · 0. biznes. FUNDACJA KORONY POLSKIEJ. Fundacja Korony Polskiej jest instytucją powołaną w ...</p>
                </div>
                <div class="search_result">
                    <a href=" " >
                        <p class="upper_info">https://es-la.facebook.com <span class="upper_info2">> AliorBankSA > posts > awa... ▼</span></p>
                        <h3>Jakub Dervill - Awaria!! gdzie jakas informacja ze dzis ...</h3>
                    </a>
                    <p class="details">Awaria!! gdzie <b>jakas informacja</b> ze dzis nastapila podobno awaria w calym kraju ze ani wplacic juz nie mowie o wyplaceniu kasy?? mam zostac bez kasy...</p>
                </div>
                <div class="search_result">
                    <a href=" " >
                        <p class="upper_info">https://ar-ar.facebook.com <span class="upper_info2">> wwwKrakowPL > posts</span></p>
                        <h3>Malwina Rzonca - Czy jest jakaś informacja telefoniczna ...</h3>
                    </a>
                    <p class="details">Czy jest <b>jakaś informacja</b> telefoniczna, dotycząca ograniczeń ruchu podczas ŚDM? Jeśli jest się mieszkańcem i ma się firmę w strefie ograniczonego ruchu,...
                    </p>
                </div>
                <div class="search_result">
                    <a href=" " >
                        <p class="upper_info">https://pl.wikipedia.org <span class="upper_info2">> wiki > Pomoc:Ponadczsowość ▼</span></p>
                        <h3>Pomoc:Ponadczasowość - Wikipedia, wolna encyklopedia</h3>
                    </a>
                    <p class="details">Jeżeli <b>jakaś informacja</b> może się stać nieaktualna – trzeba pilnować, by taka się nie stała, a gdy się jednak stanie – przeredagowywać tekst. „Ale ja aktualizuję ...
                    </p>
                </div>
                <div class="search_result">
                    <a href=" " >
                        <p class="upper_info">https://www.pocztowy.pl <span class="upper_info2">> kontakt ▼</span></p>
                        <h3>Kontakt | Bank Pocztowy</h3>
                    </a>
                    <p class="details">Masz pytania dotyczące oferty Banku, chciałbyś aktywować <b>jakąś</b> usługę lub złożyć ... Zadaj pytanie, wysyłając e-maila na adres <b>informacja</b>@pocztowy.pl.</p>
                </div>
                <div class="search_result">
                    <a href=" " >
                        <p class="upper_info">https://www.biznes.gov.pl <span class="upper_info2">> chce-zatrudnic-cudzoziemca ▼</span></p>
                        <h3>Informacja starosty o lokalnym rynku pracy | Biznes.gov.pl ...</h3>
                    </a>
                    <p class="details">Starosta wyda <b>informację</b> o możliwości zaspokojenia potrzeb kadrowych. Po przejrzeniu rejestru bezrobotnych, starosta poinformuje cię o tym czy <b>jakaś</b> osoba z ...

                    </p>
                </div>
                <div class="search_result">
                    <a href=" " >
                        <p class="upper_info">https://wwww.zus.pl <span class="upper_info2">> o-zus > komunikaty-techniczne ▼</span></p>
                        <h3>Komunikaty techniczne - Komunikaty - ZUS</h3>
                    </a>
                    <p class="details">Konto · Subkonto · <b>Informacja</b> o stanie konta ubezpieczonego w ZUS · OFE · Opis spraw. pokaż menu zwiń menu Pracujący w UE, EOG, Szwajcarii.
                    </p>
                </div>
                <div class="search_result">
                    <a href=" " >
                        <p class="upper_info">https://support.google.com <span class="upper_info2">> mail > answer ▼</span></p>
                        <h3>Odpowiedź z infromacją o urlopie lub nieobecności w biurze ...</h3>
                    </a>
                    <p class="details">Status Poza biurem możesz sprawdzić w Gmailu. Jeśli <b>jakaś</b> osoba jest poza biurem, Gmail pokazuje jej status, gdy piszesz do niej e-maila. Możesz wysłać e- ...
                    </p>
                </div>

                <br>
                <div class="list">
                    <div class="first">G</div>
                    <div class="second">o</div>
                    <div class="yellow1">o</div>
                    <div class="yellow2">o</div>
                    <div class="yellow3">o</div>
                    <div class="yellow4">o</div>
                    <div class="yellow5">o</div>
                    <div class="yellow6">o</div>
                    <div class="yellow7">o</div>
                    <div class="yellow8">o</div>
                    <div class="yellow9">o</div>
                    <div class="blue">g</div>
                    <div class="green">l</div>
                    <div class="red">e</div>
                    <div class="number1">1</div>
                    <div class="number2">2</div>
                    <div class="number3">3</div>
                    <div class="number4">4</div>
                    <div class="number5">5</div>
                    <div class="number6">6</div>
                    <div class="number7">7</div>
                    <div class="number8">8</div>
                    <div class="number9">9</div>
                    <div class="number10">10</div>
                    <div class="next1">></div>
                    <div class="next2">Następna</div>
                </div>
            </div>
            <div class="footer">
                <div class="location">
                    <a class="items">Polska</a>
                    <a class="items"><b>Dębniki, Kraków</b></a>
                    <a class="items">- Z twojego adresu internetowego</a>
                    <a href="" class="items cursor"> - Użyj dokładnej lokalizacji</a>
                    <a href="" class="items cursor"> - Dowiedz się więcej</a>
                </div>
                <div class="last">
                    <a href="" class="items cursor">Pomoc</a>
                    <a href="" class="items cursor">Prześlij opinię</a>
                    <a href="" class="items cursor">Prywatność</a>
                    <a href="" class="items cursor">Warunki</a>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        new Vue({ 
            el: '#app',
            data: {
                googleResults: false,
                googleSearch: '',
                results: [],
                current: -1,
                autocompleterResults: true,
                current: -1,
                currentResults: -1,
                autocompleterIsActive: false,
          },

          watch: {
              googleSearch: function() {
                    if (this.autocompleterIsActive)
                {
                    return;
                }

                // let filtered = this.cities.filter(city => (city.name.includes(this.value) || city.name.toLowerCase().includes(this.value)));

                if (this.googleSearch === 0)
                {
                    results = [];
                    return;
                } 
                }
            },

          methods: {
                    showResults: function(name) {
                        this.googleResults = true;
                        this.googleSearch = name;
                    },

                    showResults2: function() {
                        this.googleResults = true;
                    },

                    findResultsDebounced : Cowboy.debounce(100, function findResultsDebounced() {
                        console.log('Fetch: ', this.googleSearch);
                        fetch(`http://localhost:8080/search?name=${this.googleSearch}`)
                            .then(response => response.json())
                            .then(data => {
                                console.log('Data: ', data);
                                this.results = data;
                            });
                    }),

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
                        if (this.current < this.results.length)
                        {
                            this.current++;
                        } else if (this.current == this.results.length)
                        {
                            this.current = 0;
                        }
                        this.autocompleterIsActive = true;
                        this.googleSearch = this.results[this.current].name;
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
                            this.current = this.results.length - 1;
                        }
                        this.autocompleterIsActive = true;
                        this.googleSearch = this.results[this.current].name;
                    },

                    downResults: function() {
                        if (!this.autocompleterIsActive) {
                            this.currentResults = -1;
                        }
                        if (this.currentResults < this.results.length)
                        {
                            this.currentResults++;
                        } else if (this.currentResults == this.results.length)
                        {
                            this.currentResults = 0;
                        }
                        this.autocompleterIsActive = true;
                        this.googleSearch = this.results[this.currentResults].name;
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
                            this.currentResults = this.results.length - 1;
                        }
                        this.autocompleterIsActive = true;
                        this.googleSearch = this.results[this.currentResults].name;
                    },

                    backResults: function() {
                        this.autocompleterResults = false;
                        this.currentResults = -1;
                    }
                }
          })


    </script>
</body>
</html>