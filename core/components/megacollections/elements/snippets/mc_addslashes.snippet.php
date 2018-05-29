<?php
/**
 * PHP function: 
 * https://secure.php.net/manual/en/function.addslashes.php
 * string addslashes ( string $str )
 *
 * modx use:
 * [[*value:mc_addslashes]]
 * [[mc_addslashes? &p1=`[[*value]]`]]
 * 
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);

return addslashes($p1);