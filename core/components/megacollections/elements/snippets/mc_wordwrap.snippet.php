<?php

/**
 * PHP function: 
 * https://secure.mc_net/manual/en/function.wordwrap.php
 * string wordwrap ( string $str [, int $width = 75 [, string $break = "\n" [, bool $cut = false ]]] )
 *
 * modx use:
 * [[*value:mc_wordwrap=`start||length`]]
 * [[mc_wordwrap? &p1=`[[*value]]` &p2=`75` &p3=`\n` &p4=`true`]]
 * 
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);
$options = $modx->getOption('options', $scriptProperties, false);
@list($p2,$p3,$p4) = explode("||",$options,3);
$p2 = $modx->getOption('p2', $scriptProperties, $p2);
$p3 = $modx->getOption('p3', $scriptProperties, $p3);
$p4 = $modx->getOption('p4', $scriptProperties, $p4);

if ($p4=="false") {
	$p4=false;
}

if($p2 && $p3 && isset($p4)){
	return wordwrap($p1, $p2, $p3, $p4);
}

if($p2 && $p3){
	return wordwrap($p1, $p2, $p3);
}

if($p2){
	return wordwrap($p1, $p2);
}

return wordwrap($p1);
