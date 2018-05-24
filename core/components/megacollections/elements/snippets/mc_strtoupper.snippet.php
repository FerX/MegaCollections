<?php

/**
 * PHP function: 
 * https://secure.mc_net/manual/en/function.strtoupper.php
 * string strtoupper ( string $str )
 *
 * modx use:
 * [[*value:mc_strtoupper]]
 * [[mc_strtoupper? &p1=`[[*value]]`]]
 * 
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);

return strtoupper($p1);



