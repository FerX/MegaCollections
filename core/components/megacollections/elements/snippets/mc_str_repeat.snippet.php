<?php

/**
 * PHP function: 
 * https://secure.php.net/manual/en/function.str_repeat.php
 * string str_repeat ( string $input , int $multiplier )
 *
 * modx use:
 * [[*value:mc_str_repeat=`multiplier`]]
 * [[mc_str_repeat? &p1=`[[*value]]` &p2=`multiplier`]]
 * 
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);
$p2 = $modx->getOption('options', $scriptProperties, 0);
$p2 = $modx->getOption('p2', $scriptProperties, $p2);

return str_repeat($p1, $p2);




