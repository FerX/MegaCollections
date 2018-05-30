<?php

/**
 * REQUEST value: 
 
 * modx use:
 * [[mc_request? &name=`nomevar` &default=``]]
 * 
 */

$name = $modx->getOption('name', $scriptProperties, '');
$default = $modx->getOption('default', $scriptProperties, '');

if(isset($_REQUEST[$name])){
    return $name;
}
return $default;



