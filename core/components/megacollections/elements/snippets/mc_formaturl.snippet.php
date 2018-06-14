<?php

/**
 * Formatta un url 
 * aggiungendo/sostituendo prefisso http o https
 *
 * modx use:
 * [[*value:mc_formaturl]]
 * [[mc_formaturl? &url=`[[*value]]` &ssl=`1`]]
 */

$url = $modx->getOption('input', $scriptProperties, '');
$url = $modx->getOption('url', $scriptProperties, $url);

$options = $modx->getOption('options', $scriptProperties, false);
$ssl = $modx->getOption('ssl', $scriptProperties, $options);

$pre = "http";

if(!empty($ssl)){   
    $pre.= "s";
}

$pre.="://";


$re = '/^(http)?s?:?\/?\/?(?<baseurl>.*)/i';
preg_match($re, $url, $find);
if(!empty($find["baseurl"])){
    return $pre . $find["baseurl"];
}else{
    return $url;
}

