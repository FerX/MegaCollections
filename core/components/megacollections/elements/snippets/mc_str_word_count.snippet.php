<?php

/**
 * PHP function: 
 * https://secure.php.net/manual/en/function.str-word-count.php
 * mixed str_word_count ( string $string [, int $format = 0 [, string $charlist ]] )
 *
 * modx use:
 * [[*value:mc_str_word_count]]
 * [[mc_str_word_count? &p1=`test this file and this file`]]  
 * 
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);

$options = $modx->getOption('options', $scriptProperties, false);

@list($p2, $p3, $p4) = explode("||", $options, 2);

$p2 = $modx->getOption('p2', $scriptProperties, $p2);
$p3 = $modx->getOption('p3', $scriptProperties, $p3);

if(is_null($p2)){
    $p2=0;
}

if(is_null($p3)){
    $ret = str_word_count($p1,$p2);
}else{
    $ret = str_word_count($p1,$p2,$p3);
}

if(is_array($ret)){
    $ret=json_encode($ret);
}

return $ret;


