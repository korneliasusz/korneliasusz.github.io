<?php

//zapisanie zawartosci pliku do zmiennej
$fileJSON=file_get_contents('cities.json');

//dekodowanie z json do array
$cities=json_decode($fileJSON,true);

//definicja array
$filteredCities=array();

//sprawdzenie czy wprowadzono wartosc w url
if (isset($_GET['name'])) {
	//pobranie wartosci wpisanej w url
	$find=$_GET['name'];

	//iterowanie po array
	foreach ($cities as $city) {
		//sprawdzenie czy nazwa miasta zawiera wprowadzona fraze
		if (is_int(stripos($city["name"], $find)) /*OR strcasecmp($city["name"],$find)==0*/) {

			//wypisanie nazw wyfiltrowanych miast
			//echo $city["name"] . "<br>";
		
			//wypisanie elementow array, ktore zawierajc wyszukiwana fraze
			//var_dump($city);

			//dodanie znalezionych tablic do array
			$filteredCities[]=$city;
			
			if (count($filteredCities) == 10) {
				break;
			}
		}
	}

//wypisanie array z odpowiednimi wynikami
//print_r($filteredCities);

//zapisanie zgodnie ze standardem json
$filteredCities_json=json_encode($filteredCities);

//wypisanie zgodnie ze stadardem json
print_r($filteredCities_json);
}


?>