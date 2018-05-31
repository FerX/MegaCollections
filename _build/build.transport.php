<?php
/**
 * Build PhpCommands Package
 *
 * Description: Build script for PhpCommands package
 * @package PhpCommands
 * @subpackage build
 */


$tstart = explode(' ', microtime());
$tstart = $tstart[1] + $tstart[0];
set_time_limit(0);
 
/* define package names */
define('PKG_NAME','MegaCollections');
define('PKG_NAME_LOWER','megacollections');
define('PKG_VERSION','1.2.0');
define('PKG_RELEASE','stable');

/* define build paths */
$root = dirname(dirname(__FILE__)).'/';
$sources = array(
    'root' => $root,
    'build' => $root . '_build/',
    'data' => $root . '_build/data/',
    'resolvers' => $root . '_build/resolvers/',
    // 'chunks' => $root.'core/components/'.PKG_NAME_LOWER.'/chunks/',
    // 'lexicon' => $root . 'core/components/'.PKG_NAME_LOWER.'/lexicon/',
    'docs' => $root.'core/components/'.PKG_NAME_LOWER.'/docs/',
    'elements' => $root.'core/components/'.PKG_NAME_LOWER.'/elements/',
    // 'source_assets' => $root.'assets/components/'.PKG_NAME_LOWER,
    'source_core' => $root.'core/components/'.PKG_NAME_LOWER,
);
unset($root);
 
/* override with your own defines here (see build.config.sample.php) */
require_once $sources['build'] . 'build.config.php';
require_once MODX_CORE_PATH . 'model/modx/modx.class.php';
 
$modx= new modX();
$modx->initialize('mgr');
echo '<pre>'; /* used for nice formatting of log messages */
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget('ECHO');
 
$modx->loadClass('transport.modPackageBuilder','',false, true);
$builder = new modPackageBuilder($modx);
$builder->createPackage(PKG_NAME_LOWER,PKG_VERSION,PKG_RELEASE);
// $builder->registerNamespace(PKG_NAME_LOWER,false,true,'{core_path}components/'.PKG_NAME_LOWER.'/');


$category= $modx->newObject('modCategory');
$category->set('id',1);
$category->set('category',PKG_NAME);
 
/* add snippets */
$modx->log(modX::LOG_LEVEL_INFO,'Packaging in snippets...');
$snippets = include $sources['data'].'transport.snippets.php';
if (empty($snippets)) $modx->log(modX::LOG_LEVEL_ERROR,'Could not package in snippets.');
$category->addMany($snippets);
 
/* create category vehicle */
$attr = array(
    xPDOTransport::UNIQUE_KEY => 'category',
    xPDOTransport::PRESERVE_KEYS => false,
    xPDOTransport::UPDATE_OBJECT => true,
    xPDOTransport::RELATED_OBJECTS => true,
    xPDOTransport::RELATED_OBJECT_ATTRIBUTES => array (
        'Snippets' => array(
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => true,
            xPDOTransport::UNIQUE_KEY => 'name',
        ),
    ),
);
$vehicle = $builder->createVehicle($category,$attr);

$vehicle->resolve('file',array(
    'source' => $sources['source_core'],
    'target' => "return MODX_CORE_PATH . 'components/';",
));

$builder->putVehicle($vehicle);



$attr = array(
    'packageName' => PKG_NAME,
    'packageNameLower' => PKG_NAME_LOWER,
    'packageDescription' => 'MegaCollections - collection of php functions end othen in snippet',
    'version' => PKG_VERSION,
    'release' => PKG_RELEASE,
    'author' => 'FerX - Eracom s.r.l.',
    'authorUrl' => 'http://www.eracom.it',
    'authorSiteName' => "Eracom s.r.l.",
    // 'packageDocumentationUrl' => 'http://bobsguides.com/example-tutorial.html',
    'copyright' => '2018',
    /* no need to edit this except to change format */
    'createdon' => strftime('%m-%d-%Y'),
    'gitHubUsername' => 'FerX',
    'gitHubRepository' => 'MegaCollections',
    // 'email' => '<http://bobsguides.com>',
    // 'authorUrl' => 'http://bobsguides.com',
    // 'authorSiteName' => "Bob's Guides",
    // 'packageDocumentationUrl' => 'http://bobsguides.com/upgrademodx-tutorial.html',
    // 'copyright' => '2015-2017',
    'license' => file_get_contents($sources['docs'].'license.txt'),
    'readme' => file_get_contents($sources['docs'].'readme.txt'),
    'changelog' => file_get_contents($sources['docs'].'changelog.txt')
    );
$builder->setPackageAttributes($attr);

  

/* zip up package */
$modx->log(modX::LOG_LEVEL_INFO,'Packing up transport package zip...');
$builder->pack();
 
$tend= explode(" ", microtime());
$tend= $tend[1] + $tend[0];
$totalTime= sprintf("%2.4f s",($tend - $tstart));
$modx->log(modX::LOG_LEVEL_INFO,"\n<br />Package Built.<br />\nExecution time: {$totalTime}\n");
 
 
session_write_close();
exit ();
