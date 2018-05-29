<?php

/**
 * PHP function: 
 * https://secure.php.net/manual/en/function.nl2br.php
 * string nl2br ( string $string [, bool $is_xhtml = true ] )
 *
 * modx use:
 * [[*value:mc_nl2br=`is_xhtml`]]
 * [[mc_str_nl2br? &p1=`[[*value]]` &p2=`is_xhtml`]]
 * 
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);
$p2 = $modx->getOption('options', $scriptProperties, false);
$p2 = $modx->getOption('p2', $scriptProperties, $p2);

if($p2){
	return nl2br($p1, $p2);
}else{
	return nl2br($p1);
}

