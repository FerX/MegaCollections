<?php

/**
 * PHP function: 
 * https://secure.php.net/manual/en/function.ucfirst.php
 * string ucfirst ( string $str )
 *
 * modx use:
 * [[*value:mc_ucfirst]]
 * [[mc_ucfirst? &p1=`[[*value]]`]]
 * 
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);

return ucfirst($p1);



