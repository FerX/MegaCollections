<?php
/**
 * PHP control structure: 
 * https://secure.php.net/manual/en/control-structures.for.php
 *
 * for (expr1; expr2; expr3)
 *    statement
 *
 * modx use:
  * [[mc_for? &var=`x` &start=`1` &stop=`10` &inc=`1` &tpl=`tplfor`]]
 */

$var = $modx->getOption('var', $scriptProperties, 'x');
$start = $modx->getOption('start', $scriptProperties, '1');
$stop = $modx->getOption('stop', $scriptProperties, '10');
$inc = $modx->getOption('inc', $scriptProperties, '1');
$tpl = $modx->getOption('tpl', $scriptProperties, false);


if (empty($tpl)) {
    return "";
}

$ret="";

for ($i = 0; $i <= $stop ; $i+=$inc) {
    $ret.= $modx->getChunk($tpl,array($var=>$i));
}


return $ret;