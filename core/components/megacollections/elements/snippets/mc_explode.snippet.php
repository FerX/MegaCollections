<?php
/**
 * PHP function: 
 * https://secure.mc_net/manual/en/function.explode.php
 * array explode ( string $delimiter , string $string [, int $limit = PHP_INT_MAX ] )
 *
 * modx use:
 * [[*value:mc_explode=`delimiter`]]
 * [[*value:mc_explode=`delimiter||limit`]]
 * [[mc_explode? &p1=`[[*value]]` &p2=`delimiter` &p3=`limit`]
 *
 * return:  json
 * 
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);
$options = $modx->getOption('options', $scriptProperties, false);
@list($p2,$p3) = explode("||",$options,2);
$p2 = $modx->getOption('p2', $scriptProperties, $p2);
$p3 = $modx->getOption('p3', $scriptProperties, $p3);


if ($p2!==null && $p3!==null) {
	return $modx->toJSON(explode($p2,$p1,$p3));
}

if ($p2!==null) {
	return $modx->toJSON(explode($p2,$p1));
}

return $input;