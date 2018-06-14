<?php

/**
 * PHP function: 
 * http://php.net/manual/en/function.count.php
 * int count ( mixed $array_or_countable )
 *
 * modx use:
 * [[*value:mc_count]]
 * [[mc_count? &p1=`[[*value]]`]]
 *
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);


if (!is_array($p1)) {
	$p1 = json_decode($p1,true);
}

if(array($p1)){
    return count($p1);
}

return false;




