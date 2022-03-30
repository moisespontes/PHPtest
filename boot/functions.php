<?php

/*##### STRINGS #####*/

/**
 * Remove espaços em branco e tags de uma string
 *
 * @param string $str
 * @return string
 */
function clear_str(string $str): string
{
    $str = trim(strip_tags($str));

    $Format = array();
    $Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
    $Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------------------------------';
    return strtr(utf8_decode($str), utf8_decode($Format['a']), $Format['b']);
}

/**
 * cria o slug da URL
 *
 * @param string $slug
 * @param boolean $lcFirst
 * @return string
 */
function slug(string $slug, bool $lcFirst = false): string
{
    $slug =  str_replace(" ", "", ucwords(implode(" ", explode("-", strtolower($slug)))));
    return ($lcFirst) ? lcfirst($slug) : $slug;
}

/*##### URLs #####*/

/**
 * Uso simplificado de Urls
 *
 * @param string|null $path
 * @return string
 */
function url(string $path = null): string
{
    return URL . "/" . ($path[0] === "/" ? mb_substr($path, 1) : $path);
}
