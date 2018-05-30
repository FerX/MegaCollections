<?php

/**
 * POST value: 
 
 * modx use:
 * [[mc_post? &name=`nomevar` &default=``]]
 * 
 */

$name = $modx->getOption('name', $scriptProperties, '');
$default = $modx->getOption('default', $scriptProperties, '');

if(isset($_POST[$name])){
    return $name;
}
return $default;



