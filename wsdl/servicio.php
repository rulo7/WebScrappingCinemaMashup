<?php

//importante el archivo nusoap.php
//Referencia al archivo que contiene la clase soap_server
require_once 'lib/nusoap.php';
require_once 'scrapping/scrapping.php';

$server = new nusoap_server();
$server->configureWSDL('estrenosWsdl', 'urn:estrenosWsdl');

$server->register(
        "getCinesFromPeliculaCiudad", // nombre método
        array("pelicula" => "xsd:string", "cityCode" => "xsd:int"), //  parametros entrantes al servicio
        array("return" => "xsd:Array"), // valor(es) retornado(s)
        "urn:estrenosWsdl", // namespace (espacio de nombre)
        "urn:estrenosWsdl#getCinesFromPeliculaCiudad", // acción SOAP
        "rpc", // estílo
        "encoded", // tipo de uso
        "Devuelve una lista de cines (nombre y direccion) en la ciudad dada que emiten la película dada"// documentación
);

$server->register(
        "getCartelera", // nombre método
        array(), //  parametros entrantes al servicio
        array("return" => "xsd:Array"), // valor(es) retornado(s)
        "urn:estrenosWsdl", // namespace (espacio de nombre)
        "urn:estrenosWsdl#getCartelera", // acción SOAP
        "rpc", // estílo
        "encoded", // tipo de uso
        "Devuelve una lista de peliculas en cartelera"// documentación
);

function getCinesFromPeliculaCiudad($pelicula, $cityCode) {
    return getCinemasFromFilmInCity($pelicula, $cityCode);
}

function getCartelera() {
    return generateLastMovies();
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
