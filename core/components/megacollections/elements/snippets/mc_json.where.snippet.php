<?php
/**
 * modx use:
 *
 * [[+json:mc_json.where=`{"sex":"male"}`]]
 * 
 * [[mc_json.where? &json=`[{"name":"Joe","sex":"male"},{"name":"Rose","sex":"female"}]` &where=`{"sex":"male"}`]]
 * 
 */

$json = $modx->getOption('input', $scriptProperties, '[]');
$json = $modx->getOption('json', $scriptProperties, $json);

$where = $modx->getOption('options', $scriptProperties, false);
$where = $modx->getOption('where', $scriptProperties, $where);
 
$megaCollections = $modx->getService('megacollections', 'megaCollections', $modx->getOption('core_path') . 'components/megacollections/model/megacollections/', $scriptProperties);

if (!($megaCollections instanceof megaCollections)){return '';}

return $megaCollections->filter($json,$where);