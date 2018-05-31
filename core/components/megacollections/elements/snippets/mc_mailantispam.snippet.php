<?php

/**
 * mail antispam:
 * codifica una email per non farla leggere dai bot
 * ed utilizza output in javascript (disattivabile)

 * modx use:
 * [[*mail:mc_mailantispam]]
 * [[mc_mailantispam? &mail=`test@example.com`]]
 *
 * [[*mail:mc_mailantispam=`1`]]
 * [[mc_mailantispam? &mail=`test@example.com` &link=`1`]]
 *
 * puoi specificare anche delle classi css per il tag
 * [[mc_mailantispam? &mail=`test@example.com` &link=`1` &class=`linkmail`]]
 * 
 * in determinate situazioni è necessario disattivare l'output in js
 * [[mc_mailantispam? &mail=`test@example.com` &link=`1` &js=`0`]]
 */

$input = $modx->getOption('input', $scriptProperties, '');
$mail = $modx->getOption('mail', $scriptProperties, $input);
$options = $modx->getOption('options', $scriptProperties, false);
$link = $modx->getOption('link', $scriptProperties, $options);
$class = $modx->getOption('class', $scriptProperties, '');
$js = $modx->getOption('js', $scriptProperties, true);

if(strtolower($js)=="false"){
    $js=false;
}

$encoded = "";

for ($i = 0; $i < strlen($mail); $i++) {
    $encoded .= '&#' . ord($mail[$i]) . ';';
}

if (!empty($link)) {
    $encoded = '<a href="mailto:' . $encoded . '" class="' . $class . '">' . $encoded . '</a>';
}

if(!$js){
    return $encoded;
}

$ret='<script type="text/javascript">';

for ($i=0; $i < strlen($encoded); $i=$i+5) { 
    $ret.='document.write("'. addslashes(substr($encoded,$i,5)).'");';
}


$ret.='</script>';

return $ret;
