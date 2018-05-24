<?php

/**
 * PHP function: 
 * https://secure.mc_net/manual/en/function.substr.php
 * string substr ( string $string , int $start [, int $length ] )
 *
 * modx use:
 * [[*value:mc_substr=`start||length`]]
 * [[mc_substr? &p1=`[[*value]]` &p2=`1` &p3=`2`]]
 * 
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);
$options = $modx->getOption('options', $scriptProperties, false);
@list($p2,$p3) = explode("||",$options,2);
$p2 = $modx->getOption('p2', $scriptProperties, $p2);
$p3 = $modx->getOption('p3', $scriptProperties, $p3);

if($p3){
	return substr($p1, $p2, $p3);
}else{
	return substr($p1, $p2);
}


