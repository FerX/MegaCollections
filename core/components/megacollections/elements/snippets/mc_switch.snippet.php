<?php
/**
 * PHP construct: 
 * http://mc_net/manual/en/control-structures.switch.php
 *
 * modx use:
 * [[mc_switch? &val=`10` 
 *     &if_1=`20` &then_1=`is 20` 
 *     &if_2=`9` &op_2=`>` &then_2=`greater of 9`  
 *     &if_NN=`...` &op_NN=`...` &then_NN=`...`  
 *     &default=`xxx` 
 * ]]
 * 
 */

$val = $modx->getOption('val', $scriptProperties, false);
$default = $modx->getOption('default', $scriptProperties, "");


$megaCollections = $modx->getService('megacollections', 'megaCollections', $modx->getOption('core_path') . 'components/megacollections/model/megacollections/', $scriptProperties);

if (!($megaCollections instanceof megaCollections)){return '';}


$n=0;
while (true) {
    $n++;
    $if = $modx->getOption('if_'.$n, $scriptProperties, false);
    $then = $modx->getOption('then_'.$n, $scriptProperties, false);
    $op = $modx->getOption('op_'.$n, $scriptProperties, "==");
    
    if ($then===false || $if===false) {
        break;
    }

    $result=$megaCollections->test($val,$op,$if,null);

    if ($result===true) {
        return $then;
    }
    
}

return $default;
   
  
