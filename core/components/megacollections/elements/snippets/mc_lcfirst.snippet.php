<?php
/**
 * PHP function: 
 * https://secure.mc_net/manual/en/function.lcfirst.php
 * string lcfirst ( string $str )
 *
 * modx use:
 * [[*value:mc_lcfirst]]
 * [[mc_lcfirst? &p1=`[[*value]]`]]
 * 
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);

return lcfirst($p1);