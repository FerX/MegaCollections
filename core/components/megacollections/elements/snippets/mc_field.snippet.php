<?php

/**
 * Recupera un campo da una risorsa: 
 * 
 * &id id della risorsa (se non specificato cerca di recuperare la risorsa corrente)
 * &field nome del campo, se non specificato prende pagetitle
 * &default valore da resistuire se non trova la risorsa o il campo richiesto
 * &parent risale al genitore specificato di n volte
 * 
  * modx use:
 * [[mc_field? &id=`1`]] - recupera il pagetitle della risorsa numero 1
 * 
 * [[mc_field? &id=`1` &field=`tvField`]] - recupera la tv variable della risorsa 1
 
 * [[mc_field? &parent=`1`]] - recupera il page title della risorsa genitore di quella corrente
 * 
 * 
 * 
 */

$id = $modx->getOption('id', $scriptProperties, false);
if (!$id) {
    if (!empty($modx->resource->id)) {
        $id = $modx->resource->id;
    } else {
        return "";
    }
}

$field = $modx->getOption('field', $scriptProperties, 'pagetitle');
$default = $modx->getOption('default', $scriptProperties, '');
$parent = $modx->getOption('parent', $scriptProperties, false);

if ($modx->resource->id == $id) {
    $resource = $modx->resource;
} else {
    $resource = $modx->getObject('modResource', $id);
}

if (!$resource) {
    return $default;
}

if($parent >=1){
    for ($i=0; $i < $parent; $i++) { 
        if(!empty($resource->get('parent'))){
            $resource = $modx->getObject('modResource', $resource->get('parent'));
        }
    }
}

if (!$resource) {
    return $default;
}


$val = $resource->get($field);

if ($val === null) {
    $val = $resource->getTVValue($field);
}

if ($val === null) {
    return $default;
}

return $val;





