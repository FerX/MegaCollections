<?php

/**
 * PHP function: 
 * https://secure.php.net/manual/en/function.hex2bin.php
 * string hex2bin ( string $str )
 *
 * modx use:
 * [[*value:mc_hex2bin]]
 * [[mc_hex2bin? &p1=`[[*value]]`]]
 * 
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);

return hex2bin($p1);



