<?php
/**
 * PHP function: 
 * https://secure.php.net/manual/en/function.strrev.php
 * string strrev ( string $string )
 *
 * modx use:
 * [[*value:mc_strrev]]
 * [[mc_strrev? &p1=`[[*value]]`]]
 * 
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);

return strrev($p1);