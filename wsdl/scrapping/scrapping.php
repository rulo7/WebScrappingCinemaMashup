<?php

require_once __DIR__ . "/simple_html_dom.php";

/**
 * 
 * @return ArrayObject
 */
function generateLastMovies() {

    $html = file_get_html("http://www.sensacine.com/peliculas/en-cartelera/cines/");

    $cont = 0;
    foreach ($html->find('h2[class=tt_18 d_inline]') as $element) {
        foreach ($element->find('a') as $filmName) {
            $peliculasIt[$cont] = $filmName->plaintext;
        }
        $cont++;
    }

    return $peliculasIt;
}

/**
 * Madrid: 72368
 * @param type $cityCode
 * @param type $pelicula
 * @return ArrayObject
 */
function getCinemasFromFilmInCity($pelicula, $cityCode) {

    $cinesIt = null;

    $html = file_get_html("http://www.sensacine.com/peliculas/en-cartelera/cines/");

    foreach ($html->find('h2[class=tt_18]') as $element) {

        foreach ($element->find('a') as $filmName) {


            if (strcmp($filmName->plaintext, $pelicula) == 0) {

                $page = 1;
                $lastCinema = "";
                $count = 0;
                $sublink = $filmName->href;

                do {


                    $html2 = file_get_html("http://www.sensacine.com" . $sublink . "sesiones/cerca-de/?cgeocode=$cityCode&page=$page");


                    $j = 0;
                    foreach ($html2->find('a[class=no_underline j_entities]') as $dir) {

                        if (strcmp($dir->plaintext, $lastCinema) != 0) {
                            $cinesIt[$j + $count]["name"] = $dir->plaintext;
                            $j++;
                        } else {
                            return $cinesIt;
                        }
                    }



                    $impar = 0;
                    $k = 0;
                    foreach ($html2->find('span.lighten') as $dir) {
                        if ($impar % 2 != 0) {
                            $cinesIt[$k + $count]["dir"] = $dir->plaintext;
                            $k++;
                        }
                        $impar++;
                    }

                    $page++;
                    $lastCinema = $cinesIt[0]["name"];
                    $count += $j;
                } while ($cinesIt != null);

                return $cinesIt;
            }
        }
    }
    
     return null;
}
