<?php

/**
 * GET value: 
 
 * modx use:
 * [[mc_get? &name=`nomevar` &default=``]]
 * 
 */

$name = $modx->getOption('name', $scriptProperties, '');
$default = $modx->getOption('default', $scriptProperties, '');

if(isset($_GET[$name])){
    return $name;
}
return $default;



