<?php
/**
 * Set Placeholder
 *
 * [[mc_ph? &var=`newvar` &val=`10`]]
 * [[mc_ph? &var=`newvar` &val=`10` &prefix=`prefix` &separator=`.`]]
 *
 * Set Json to Placeholders
 * 
 * [[mc_ph? &var=`color` &val=`["red","blue","brown"]`]]
 * create   color.1=red   color.2=blue   color.3=brown  
 *
 * [[mc_ph? &var=`people` &val=`{"Joe":"male","Rose":"female"}`]]
 * create   people.Joe=male   people.Rose=female   
 * 
 * Delete Placeholder 
 * 
 * [[mc_ph? &var=`newvar` &del=`1`]]
 */


$var = $modx->getOption('var', $scriptProperties, false);
$val = $modx->getOption('val', $scriptProperties, false);
$prefix = $modx->getOption('prefix', $scriptProperties, "");
$separator = $modx->getOption('separator', $scriptProperties, ".");
$del = $modx->getOption('del', $scriptProperties, false);
$where = $modx->getOption('where', $scriptProperties, false);
$sort = $modx->getOption('sort', $scriptProperties, false);

if ($var==false) {
    return "";
}

if ($del) {
    $modx->unsetPlaceholder($prefix.$var);
    return "";
}

if ($val===false) {
    return $modx->getPlaceholder($prefix.$var);
}



$megaCollections = $modx->getService('megacollections', 'megaCollections', $modx->getOption('core_path') . 'components/megacollections/model/megacollections/', $scriptProperties);

if (!($megaCollections instanceof megaCollections)){return '';}

$val = $megaCollections->filter($val,$where);
$val = $megaCollections->sort($val,$sort);

if ($aVal=$modx->fromJSON($val)) {
    $val=$aVal;
}

$modx->toPlaceholder($var,$val,$prefix,$separator);

return "";   

