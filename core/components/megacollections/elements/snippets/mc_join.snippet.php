<?php

/**
 * PHP function: 
 * https://secure.php.net/manual/en/function.join.php
 * array string join ( string $glue , array $pieces )
 *
 * json $input
 * string $options
 *
 * modx use:
 * [[*value:mc_join]]
 * [[*value:mc_join=`glue`]]
 * [[mc_join? &p1=`[[*value]]` &p2=`glue`]]
 *
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);
$p2 = $modx->getOption('options', $scriptProperties, '');
$p2 = $modx->getOption('p2', $scriptProperties, $p2);

return implode(json_decode($p1,true), $p2);


