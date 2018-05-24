<?php

/**
 * PHP function: 
 * https://secure.mc_net/manual/en/function.count-chars.php
 * mixed count_chars ( string $string [, int $mode = 0 ] )
 *
 * modx use:
 * [[*value:mc_count_chars]]
 * [[*value:mc_count_chars=`mode`]]
 * [[mc_count_chars? &p1=`[[*value]]` &p2=`mode`]]
 *
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);
$p2 = $modx->getOption('options', $scriptProperties, false);
$p2 = $modx->getOption('p2', $scriptProperties, $p2);


if ($p2) {
	$ret = count_chars($p1, $p2);
}else{
	$ret = count_chars($p1);
}

if (is_array($ret)) {
	$ret = json_encode($ret);
}

return $ret;




