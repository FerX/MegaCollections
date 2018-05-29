<?php

/**
 * PHP function: 
 * https://secure.php.net/manual/en/function.bin2hex.php
 * string bin2hex ( string $str )
 *
 * modx use:
 * [[*value:mc_bin2hex]]
 * [[mc_bin2hex? &p1=`[[*value]]`]]
 * 
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);

return bin2hex($p1);



