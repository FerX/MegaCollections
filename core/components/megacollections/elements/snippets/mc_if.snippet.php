<?php
/**
 * PHP construct: 
 * http://mc_net/manual/en/control-structures.if.php
 *
 * modx use:
 * [[*value:mc_if=`==||b`:then=``:else=``]]
 * [[*value:mc_if=`b`:then=``:else=``]]
 * or
 * [[mc_if? &p1=`a` &p2=`==` &p3=`b` &p4=`...then..` &p5=`..else..`]]
 * or
 * [[mc_if? &p1=`a` &p2=`==` &p3=`b` &then=`...then..` &else=`..else..`]]
 *
 * operator
 * ==, >, <, >=, <=, !=, empty, !empty||notempty, in, start, end, inarray|inlist|injson
 * 
 */


$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);
$options = $modx->getOption('options', $scriptProperties, false);
@list($p2,$p3) = explode("||",$options,2);
if (empty($p3)) {
    $p3=$p2;
    $p2="==";
}
$p2 = $modx->getOption('p2', $scriptProperties, $p2);
$p3 = $modx->getOption('p3', $scriptProperties, $p3);
$p4 = $modx->getOption('p4', $scriptProperties, $modx->getOption('then', $scriptProperties, true));
$p5 = $modx->getOption('p5', $scriptProperties, $modx->getOption('else', $scriptProperties, false));


$megaCollections = $modx->getService('megacollections', 'megaCollections', $modx->getOption('core_path') . 'components/megacollections/model/megacollections/', $scriptProperties);

if (!($megaCollections instanceof megaCollections)){return '';}


$result=$megaCollections->test($p1,$p2,$p3);

if ($result===null) {
   return "";
}

if ($result) {
    return $p4;
}else{
    return $p5;
}

