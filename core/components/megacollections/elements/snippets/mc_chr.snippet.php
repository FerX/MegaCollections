<?php
/**
 * PHP function: 
 * https://secure.php.net/manual/en/function.chr.php
 * string chr ( int $ascii )
 *
 * modx use:
 * [[*value:mc_chr]]
 * [[mc_chr? &p1=`[[*value]]`]]
 * 
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);

return chr($p1);