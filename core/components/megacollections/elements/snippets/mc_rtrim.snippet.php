<?php

/**
 * PHP function: 
 * https://secure.php.net/manual/en/function.rtrim.php
 * string rtrim ( string $str [, string $character_mask = " \t\n\r\0\x0B" ] )
 *
 * modx use:
 * [[*value:mc_rtrim=`character_mask`]]
 * [[mc_rtrim? &p1=`[[*value]]` &p2=`character_mask`]]
 * 
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);
$p2 = $modx->getOption('options', $scriptProperties, false);
$p2 = $modx->getOption('p2', $scriptProperties, $p2);

if($p2){
	return rtrim($p1, $p2);
}else{
	return rtrim($p1);
}




