<?php
/**
 * modx use:
 *
 * [[+json:mc_json.sort=`{"name":"asc"}`]]
 * [[mc_json.sort? &json=`[{"name":"Joe","sex":"male"},{"name":"Rose","sex":"female"}]` &sort=`{"name":"asc"}`]]
 *
 * [[!mc_json.sort? &json=`[{"name":"A","sex":"male"},{"name":"B","sex":"female"},{"name":"C","sex":"female"}]` &sort=`{"sex":"ASC","name":"RANDOM"}`]]
 * 
 */

$json = $modx->getOption('input', $scriptProperties, '[]');
$json = $modx->getOption('json', $scriptProperties, $json);

$sort = $modx->getOption('options', $scriptProperties, false);
$sort = $modx->getOption('sort', $scriptProperties, $sort);
 
$megaCollections = $modx->getService('megacollections', 'megaCollections', $modx->getOption('core_path') . 'components/megacollections/model/megacollections/', $scriptProperties);

if (!($megaCollections instanceof megaCollections)){return '';}

return $megaCollections->sort($json,$sort);