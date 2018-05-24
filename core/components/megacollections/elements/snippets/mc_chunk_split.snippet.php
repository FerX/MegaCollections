<?php

/**
 * PHP function: 
 * https://secure.mc_net/manual/en/function.chunk-split.php
 * string chunk_split ( string $body [, int $chunklen = 76 [, string $end = "\r\n" ]] )
 *
 * modx use:
 * [[*value:mc_chunk_split]]
 * [[*value:mc_chunk_split=`76||\r\n`]]
 * [[mc_chunk_split? &p1=`[[*value]]` &p2=`76` &p3=`\r\n` ]]
 * 
 */

$p1 = $modx->getOption('input', $scriptProperties, '');
$p1 = $modx->getOption('p1', $scriptProperties, $p1);
$options = $modx->getOption('options', $scriptProperties, false);
@list($p2,$p3) = explode("||",$options,2);
$p2 = $modx->getOption('p1', $scriptProperties, $p2);
$p3 = $modx->getOption('p2', $scriptProperties, $p3);


if ($p2!==null && $p3!==null) {
	return chunk_split($p1,$p2,$p3);
}

if ($p2!==null && $p3===null) {
	return chunk_split($p1,$p2);
}

return chunk_split($p1);



