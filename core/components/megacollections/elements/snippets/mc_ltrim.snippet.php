<?php

/**
 * PHP function: 
 * https://secure.php.net/manual/en/function.ltrim.php
 * string ltrim ( string $str [, string $character_mask = " \t\n\r\0\x0B" ] )
 *
 * modx use:
 * [[*value:mc_ltrim=`character_mask`]]
 * [[mc_ltrim? &p1=`[[*value]]` &p2=`character_mask`]]
 * 
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);
$p2 = $modx->getOption('options', $scriptProperties, false);
$p2 = $modx->getOption('p2', $scriptProperties, $p2);

if($p2){
	return ltrim($p1, $p2);
}else{
	return ltrim($p1);
}




