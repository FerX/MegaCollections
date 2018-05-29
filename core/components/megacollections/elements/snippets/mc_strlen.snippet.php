<?php

/**
 * PHP function: 
 * https://secure.php.net/manual/en/function.strlen.php
 *
 * modx use:
 * [[*value:mc_strlen]]
 * [[mc_strlen? &p1=`[[*value]]`]]
 * 
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);
return strlen($p1);




