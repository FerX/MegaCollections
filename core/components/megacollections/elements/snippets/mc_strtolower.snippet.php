<?php

/**
 * PHP function: 
 * https://secure.mc_net/manual/en/function.strtolower.php
 * string strtolower ( string $str )
 *
 * modx use:
 * [[*value:mc_strtolower]]
 * [[mc_strtolower? &p1=`[[*value]]`]]
 * 
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);

return strtolower($p1);



