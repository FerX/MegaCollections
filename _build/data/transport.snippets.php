<?php
function getSnippetContent($filename) {
    $o = file_get_contents($filename);
    $o = trim(str_replace(array('<?php','?>'),'',$o));
    return $o;
}
$snippets = array();
 

$files = glob($sources['elements'].'snippets/*.snippet.php', GLOB_BRACE);

$ctr=0;

foreach($files as $file) {
    $ctr++;
    $nomefile=substr($file,strrpos($file,"/")+1);
    $nome=str_replace(".php", "", $nomefile);
    $nome=str_replace(".snippet", "", $nome);

    print("\n Aggiungo file $file|$nomefile|$nome");
    $snippets[$ctr]= $modx->newObject('modSnippet');
    $snippets[$ctr]->fromArray(array(
        'id' => $snippets,
        'name' => $nome,
        'description' => '',
        'snippet' => getSnippetContent($file),
    ),'',true,true);
    // $properties = include $sources['data'].'properties/properties.doodles.php';
    // $snippets[1]->setProperties($properties);
    // unset($properties);

}


 
return $snippets;