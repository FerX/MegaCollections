<?php

/**
 * PHP function: 
 * https://secure.php.net/manual/en/function.substr-count.php
 * int substr_count ( string $haystack , string $needle [, int $offset = 0 [, int $length ]] )
 *
 * modx use:
 * [[*value:mc_substr_count]]
 * [[mc_substr_count? &p1=`This is a test` &p2=`is`]]  - result 2
 * 
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);

$options = $modx->getOption('options', $scriptProperties, false);

@list($p2, $p3, $p4) = explode("||", $options, 3);

$p2 = $modx->getOption('p2', $scriptProperties, $p2);
$p3 = $modx->getOption('p3', $scriptProperties, $p3);
$p4 = $modx->getOption('p4', $scriptProperties, $p4);

if(is_null($p3)){
    $p3=0;
}

if(is_null($p4)){
    return substr_count($p1,$p2,$p3);
}

return substr_count($p1,$p2,$p3,$p4);

