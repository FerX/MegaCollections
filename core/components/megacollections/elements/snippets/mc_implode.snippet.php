<?php

/**
 * PHP function: 
 * https://secure.php.net/manual/en/function.implode.php
 * array string implode ( string $glue , array $pieces )
 *
 * json $input
 * string $options
 *
 * modx use:
 * [[*value:mc_implode]]
 * [[*value:mc_implode=`glue`]]
 * [[mc_implode? &p1=`[[*value]]` &p2=`glue`]]
 *
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);
$p2 = $modx->getOption('options', $scriptProperties, "");
$p2 = $modx->getOption('p2', $scriptProperties, $p2);

return implode($modx->fromJSON($p1), $p2);





