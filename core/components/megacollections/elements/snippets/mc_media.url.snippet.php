<?php
/**
 * Ottiene l'url di una media source
 * 
 * From id:
 * 
 * [[+tvImage:mc_media.url=`3`]]
 * [[mc_media.url? &val=`` &id=``]]
 * 
 * 
 * From tv:
 * 
 * [[+tvImage:mc_media.url=`tvName`]]
 * [[mc_media.url? &val=`` &tv=``]]
 * 
 * 
 */


$val = $modx->getOption('input', $scriptProperties, false);
$val = $modx->getOption('val', $scriptProperties, $val);

$options = $modx->getOption('options', $scriptProperties, false);
$sel = $modx->getOption('tv', $scriptProperties, $options);
$sel = $modx->getOption('id', $scriptProperties, $sel);

$ret=$val;

//Se non è numerico è una TV
if (!is_numeric($sel)) {
    if ($tv = $modx->getObject('modTemplateVar', array('name' => $sel))) {
        $ret=$tv->prepareOutput($val);
    }
}else{
    $ret = str_replace('./','',$val);
    if ($ms = $modx->getObject('sources.modMediaSource',$sel)){
        $ret = $ms->prepareOutputUrl($ret);
    }
    $ret= '/' . $ret;
}



return $ret;   

