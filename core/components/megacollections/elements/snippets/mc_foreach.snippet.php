<?php
/**
 * PHP control structure: 
 * https://secure.php.net/manual/en/control-structures.foreach.php
 *
 * foreach (array_expression as $value)
 *     statement
 * foreach (array_expression as $key => $value)
 *     statement
 *
 * modx use:
 * [[*json:mc_foreach=`key||value||tpl||tplempty`]]
 * [[mc_foreach? &p1=`[[*json]]` &p2=`key` &p3=`value` &p4=`tpl` &p5=`tplempty`]]
 * or
 * [[mc_foreach? &p1=`[[*json]]` &p2=`key` &p3=`value` &tpl=`tpl` &tplempty=`tplempty` &where=``]]
 *
 * 
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);

$options = $modx->getOption('options', $scriptProperties, "");
@list($p2,$p3,$p4,$p5) = explode("||",$options,4);
if (empty($p2)) $p2="key";
if (empty($p3)) $p3="value";

$p2 = $modx->getOption('p2', $scriptProperties, $p2);
$p3 = $modx->getOption('p3', $scriptProperties, $p3);
$p4 = $modx->getOption('p4', $scriptProperties, $p4);
$p4 = $modx->getOption('tpl', $scriptProperties, $p4);
$p5 = $modx->getOption('p5', $scriptProperties, $p5);
$p5 = $modx->getOption('tplempty', $scriptProperties, $p5);
$where = $modx->getOption('where', $scriptProperties, false);
$sort = $modx->getOption('sort', $scriptProperties, false);
  


$megaCollections = $modx->getService('megacollections', 'megaCollections', $modx->getOption('core_path') . 'components/megacollections/model/megacollections/', $scriptProperties);

if (!($megaCollections instanceof megaCollections)){return '';}

$data=$modx->fromJSON($p1);

if (empty($data) || !is_array($data)) {
    return $modx->getChunk($p5);
}

$data = $megaCollections->filter($data,$where);

$data = $megaCollections->sort($data,$sort);


$ret="";
foreach ($data as $key => $value) {
    if(is_array($value)) $value=$modx->toJSON($value);
    $ret.= $modx->getChunk($p4,array($p2=>$key,$p3=>$value));
}

return $ret;
