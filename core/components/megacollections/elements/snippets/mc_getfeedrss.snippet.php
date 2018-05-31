<?php

/**
 * getfeedrss
 * legge un feed rss da un url e lo elabora tramite specifici chunk
 *
 * [[mc_getfeedrss?
 *  &url=``
 *  &tpl=``
 *  &wrapperTpl=``
 *  &limit=``
 *  &offset=``
 *  $toPlaceholder=``
 * ]]
 */

$url = $modx->getOption('url', $scriptProperties, false);
$tpl = $modx->getOption('tpl', $scriptProperties, false);
$wrapperTpl = $modx->getOption('wrapperTpl', $scriptProperties, false);
$limit = $modx->getOption('limit', $scriptProperties, 0);
$offset = $modx->getOption('offset', $scriptProperties, 0);
$toPlaceholder = $modx->getOption('toPlaceholder', $scriptProperties, false);

if (empty($url)) {
    return "";
}

if(!is_numeric($limit) || $limit < 0){
    $limit=0;
}

if (!is_numeric($offset) || $offset < 0) {
    $offset = 0;
}


$feed = implode(file($url));
$xml = simplexml_load_string($feed);
$json = json_encode($xml);
$data = json_decode($json, true);
$items = $data['channel']['item'];
unset($data['channel']['item']);
$ret_items = array();

$total = count($items);
$idx = 0;
foreach ($items as $item) {
    $idx++;
    if ($limit > 0 && count($ret_items) >= $limit) {
        break;
    }
    if ($offset > 0 && $offset >= $idx) {
        continue;
    }
    $item['idx']=$idx;
    if (!empty($tpl)) {
        $ret_items[] = $modx->getChunk($tpl, $item);
    } else {
        $ret_items[] = "<pre>" . print_r($item, true) . "</pre>";
    }

}

$ret = implode("\n", $ret_items);

if (!empty($wrapperTpl)) {
    $prop = array_merge($scriptProperties, $data['channel']);
    $prop['wrapper'] = $ret;
    $ret = $modx->getChunk($wrapperTpl, $prop);
}

if(!empty($toPlaceholder)){
    $modx->toPlaceholder($toPlaceholder, $ret);
}else{
    return $ret;
}

