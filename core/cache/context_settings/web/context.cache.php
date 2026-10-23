<?php  return array (
  'config' => 
  array (
    'cultureKey' => 'ru',
  ),
  'aliasMap' => 
  array (
    'index.html' => 1,
    'o-nas/' => 9,
    '404.html' => 3,
    'uslygi/' => 5,
    'kachestvo-(galereya).html' => 16,
    'kachestvo.html' => 4,
    'kontaktyi.html' => 2,
    'soblyudenie-korporativnyih-trebovanij.html' => 413,
    'uslygi/sborka.html' => 6,
    'uslygi/novosti.html' => 15,
    'uslygi/metaloobrabotka.html' => 20,
    'uslygi/lityo-plasmass.html' => 21,
    'o-nas/novosti/n-3.html' => 12,
    'o-nas/novosti/n-4.html' => 13,
    'o-nas/novosti/n-5.html' => 14,
    'o-nas/novosti/' => 7,
    'uslygi/novosti/novost-1.html' => 8,
    'uslygi/novosti/novost-2-vakansii.html' => 11,
  ),
  'resourceMap' => 
  array (
    0 => 
    array (
      0 => 1,
      1 => 9,
      2 => 3,
      3 => 5,
      4 => 16,
      5 => 4,
      6 => 2,
      7 => 413,
    ),
    5 => 
    array (
      0 => 6,
      1 => 15,
      2 => 20,
      3 => 21,
    ),
    7 => 
    array (
      0 => 12,
      1 => 13,
      2 => 14,
    ),
    9 => 
    array (
      0 => 7,
    ),
    15 => 
    array (
      0 => 8,
      1 => 11,
    ),
  ),
  'webLinkMap' => 
  array (
  ),
  'eventMap' => 
  array (
    'OnBeforeSaveWebPageCache' => 
    array (
      7 => '7',
    ),
    'OnChunkFormPrerender' => 
    array (
      8 => '8',
    ),
    'OnContextRemove' => 
    array (
      16 => '16',
    ),
    'OnDocFormPrerender' => 
    array (
      4 => '4',
      8 => '8',
      16 => '16',
    ),
    'OnDocFormSave' => 
    array (
      16 => '16',
    ),
    'OnEmptyTrash' => 
    array (
      16 => '16',
    ),
    'OnFileCreateFormPrerender' => 
    array (
      8 => '8',
    ),
    'OnFileEditFormPrerender' => 
    array (
      8 => '8',
    ),
    'OnFileManagerUpload' => 
    array (
      6 => '6',
    ),
    'OnHandleRequest' => 
    array (
      26 => '26',
    ),
    'OnMODXInit' => 
    array (
      7 => '7',
      2 => '2',
    ),
    'OnPluginFormPrerender' => 
    array (
      8 => '8',
    ),
    'OnResourceDuplicate' => 
    array (
      16 => '16',
    ),
    'OnResourceSort' => 
    array (
      16 => '16',
    ),
    'OnRichTextBrowserInit' => 
    array (
      1 => '1',
    ),
    'OnRichTextEditorInit' => 
    array (
      1 => '1',
    ),
    'OnRichTextEditorRegister' => 
    array (
      8 => '8',
      1 => '1',
    ),
    'OnSiteRefresh' => 
    array (
      16 => '16',
      7 => '7',
    ),
    'OnSnipFormPrerender' => 
    array (
      8 => '8',
    ),
    'OnTempFormPrerender' => 
    array (
      8 => '8',
    ),
    'OnTVInputPropertiesList' => 
    array (
      4 => '4',
    ),
    'OnTVInputRenderList' => 
    array (
      4 => '4',
    ),
  ),
  'pluginCache' => 
  array (
    1 => 
    array (
      'id' => '1',
      'source' => '0',
      'property_preprocess' => '0',
      'name' => 'CKEditor',
      'description' => 'CKEditor WYSIWYG editor plugin for MODx Revolution',
      'editor_type' => '0',
      'category' => '0',
      'cache_type' => '0',
      'plugincode' => '/**
 * CKEditor WYSIWYG Editor Plugin
 *
 * Events: OnManagerPageBeforeRender, OnRichTextEditorRegister, OnRichTextEditorInit, OnRichTextBrowserInit
 *
 * @var modX $modx
 * @author Danil Kostin <danya.postfactum(at)gmail.com>
 *
 * @package ckeditor
 */
$enabled = $modx->getOption(\'which_editor\', null, \'CKEditor\') == \'CKEditor\' && $modx->getOption(\'use_editor\', null, true);

switch ($modx->event->name) {
    case \'OnRichTextEditorRegister\':
        $modx->event->output(\'CKEditor\');
        break;
    case \'OnManagerPageBeforeRender\':
        if ($enabled) {
            /** @var CKEditor $ckeditor */
            $ckeditor = $modx->getService(\'ckeditor\', \'CKEditor\', $modx->getOption(\'ckeditor.core_path\', null, $modx->getOption(\'core_path\').\'components/ckeditor/\') . \'model/ckeditor/\');
            $ckeditor->initialize();
        }
        break;
    case \'OnRichTextEditorInit\':
        break;
    case \'OnRichTextBrowserInit\':
        if ($enabled) {
            $funcNum = $_REQUEST[\'CKEditorFuncNum\'];
            $modx->event->output("function(data){
                window.parent.opener.CKEDITOR.tools.callFunction({$funcNum}, data.fullRelativeUrl);
            }");
        }
        break;
}

return;',
      'locked' => '0',
      'properties' => NULL,
      'disabled' => '0',
      'moduleguid' => '',
      'static' => '1',
      'static_file' => 'ckeditor/elements/plugins/ckeditor.plugin.php',
    ),
    2 => 
    array (
      'id' => '2',
      'source' => '0',
      'property_preprocess' => '0',
      'name' => 'ClientConfig',
      'description' => 'Sets system settings from the Client Config CMP.',
      'editor_type' => '0',
      'category' => '0',
      'cache_type' => '0',
      'plugincode' => '/**
 * ClientConfig
 *
 * Copyright 2011-2014 by Mark Hamstra <hello@markhamstra.com>
 *
 * ClientConfig is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * ClientConfig is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * ClientConfig; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package clientconfig
 *
 * @var modX $modx
 * @var int $id
 * @var string $mode
 * @var modResource $resource
 * @var modTemplate $template
 * @var modTemplateVar $tv
 * @var modChunk $chunk
 * @var modSnippet $snippet
 * @var modPlugin $plugin
*/

$eventName = $modx->event->name;

switch($eventName) {
    case \'OnMODXInit\':
        /* Grab the class */
        $path = $modx->getOption(\'clientconfig.core_path\', null, $modx->getOption(\'core_path\') . \'components/clientconfig/\');
        $path .= \'model/clientconfig/\';
        $clientConfig = $modx->getService(\'clientconfig\',\'ClientConfig\', $path);

        /* If we got the class (gotta be careful of failed migrations), grab settings and go! */
        if ($clientConfig instanceof ClientConfig) {
            $settings = $clientConfig->getSettings();

            /* Make settings available as [[++tags]] */
            $modx->setPlaceholders($settings, \'+\');

            /* Make settings available for $modx->getOption() */
            foreach ($settings as $key => $value) {
                $modx->setOption($key, $value);
            }
        }
        break;
}

return;',
      'locked' => '0',
      'properties' => NULL,
      'disabled' => '0',
      'moduleguid' => '',
      'static' => '0',
      'static_file' => '',
    ),
    4 => 
    array (
      'id' => '4',
      'source' => '0',
      'property_preprocess' => '0',
      'name' => 'MIGX',
      'description' => '',
      'editor_type' => '0',
      'category' => '4',
      'cache_type' => '0',
      'plugincode' => '$corePath = $modx->getOption(\'migx.core_path\',null,$modx->getOption(\'core_path\').\'components/migx/\');
$assetsUrl = $modx->getOption(\'migx.assets_url\', null, $modx->getOption(\'assets_url\') . \'components/migx/\');
switch ($modx->event->name) {
    case \'OnTVInputRenderList\':
        $modx->event->output($corePath.\'elements/tv/input/\');
        break;
    case \'OnTVInputPropertiesList\':
        $modx->event->output($corePath.\'elements/tv/inputoptions/\');
        break;

        case \'OnDocFormPrerender\':
        $modx->controller->addCss($assetsUrl.\'css/mgr.css\');
        break; 
 
    /*          
    case \'OnTVOutputRenderList\':
        $modx->event->output($corePath.\'elements/tv/output/\');
        break;
    case \'OnTVOutputRenderPropertiesList\':
        $modx->event->output($corePath.\'elements/tv/properties/\');
        break;
    
    case \'OnDocFormPrerender\':
        $assetsUrl = $modx->getOption(\'colorpicker.assets_url\',null,$modx->getOption(\'assets_url\').\'components/colorpicker/\'); 
        $modx->regClientStartupHTMLBlock(\'<script type="text/javascript">
        Ext.onReady(function() {
            
        });
        </script>\');
        $modx->regClientStartupScript($assetsUrl.\'sources/ColorPicker.js\');
        $modx->regClientStartupScript($assetsUrl.\'sources/ColorMenu.js\');
        $modx->regClientStartupScript($assetsUrl.\'sources/ColorPickerField.js\');		
        $modx->regClientCSS($assetsUrl.\'resources/css/colorpicker.css\');
        break;
     */
}
return;',
      'locked' => '0',
      'properties' => 'a:0:{}',
      'disabled' => '0',
      'moduleguid' => '',
      'static' => '0',
      'static_file' => '',
    ),
    6 => 
    array (
      'id' => '6',
      'source' => '0',
      'property_preprocess' => '0',
      'name' => 'migxResizeOnUpload',
      'description' => '',
      'editor_type' => '0',
      'category' => '4',
      'cache_type' => '0',
      'plugincode' => '/**
 * migxResizeOnUpload Plugin
 *
 * Events: OnFileManagerUpload
 * Author: Bruno Perner <b.perner@gmx.de>
 * Modified to read multiple configs from mediasource-property
 * 
 * First Author: Vasiliy Naumkin <bezumkin@yandex.ru>
 * Required: PhpThumbOf snippet for resizing images
 * 
 * Example: mediasource - property \'resizeConfig\':
 * [{"alias":"origin","w":"500","h":"500","far":1},{"alias":"thumb","w":"150","h":"150","far":1}]
 */

if ($modx->event->name != \'OnFileManagerUpload\') {
    return;
}


$file = $modx->event->params[\'files\'][\'file\'];
$directory = $modx->event->params[\'directory\'];

if ($file[\'error\'] != 0) {
    return;
}

$name = $file[\'name\'];
//$extensions = explode(\',\', $modx->getOption(\'upload_images\'));

$source = $modx->event->params[\'source\'];

if ($source instanceof modMediaSource) {
    //$dirTree = $modx->getOption(\'dirtree\', $_REQUEST, \'\');
    //$modx->setPlaceholder(\'docid\', $resource_id);
    $source->initialize();
    $basePath = str_replace(\'/./\', \'/\', $source->getBasePath());
    //$cachepath = $cachepath . $dirTree;
    $baseUrl = $modx->getOption(\'site_url\') . $source->getBaseUrl();
    //$baseUrl = $baseUrl . $dirTree;
    $sourceProperties = $source->getPropertyList();

    //echo \'<pre>\' . print_r($sourceProperties, 1) . \'</pre>\';
    //$allowedExtensions = $modx->getOption(\'allowedFileTypes\', $sourceProperties, \'\');
    //$allowedExtensions = empty($allowedExtensions) ? \'jpg,jpeg,png,gif\' : $allowedExtensions;
    //$maxFilesizeMb = $modx->getOption(\'maxFilesizeMb\', $sourceProperties, \'8\');
    //$maxFiles = $modx->getOption(\'maxFiles\', $sourceProperties, \'0\');
    //$thumbX = $modx->getOption(\'thumbX\', $sourceProperties, \'100\');
    //$thumbY = $modx->getOption(\'thumbY\', $sourceProperties, \'100\');
    $resizeConfigs = $modx->getOption(\'resizeConfigs\', $sourceProperties, \'\');
    $resizeConfigs = $modx->fromJson($resizeConfigs);
    $thumbscontainer = $modx->getOption(\'thumbscontainer\', $sourceProperties, \'thumbs/\');
    $imageExtensions = $modx->getOption(\'imageExtensions\', $sourceProperties, \'jpg,jpeg,png,gif,JPG\');
    $imageExtensions = explode(\',\', $imageExtensions);
    //$uniqueFilenames = $modx->getOption(\'uniqueFilenames\', $sourceProperties, false);
    //$onImageUpload = $modx->getOption(\'onImageUpload\', $sourceProperties, \'\');
    //$onImageRemove = $modx->getOption(\'onImageRemove\', $sourceProperties, \'\');
    $cleanalias = $modx->getOption(\'cleanFilename\', $sourceProperties, false);

}

if (is_array($resizeConfigs) && count($resizeConfigs) > 0) {
    foreach ($resizeConfigs as $rc) {
        if (isset($rc[\'alias\'])) {
            $filePath = $basePath . $directory;
            $filePath = str_replace(\'//\',\'/\',$filePath);
            if ($rc[\'alias\'] == \'origin\') {
                $thumbPath = $filePath;
            } else {
                $thumbPath = $filePath . $rc[\'alias\'] . \'/\';
                $permissions = octdec(\'0\' . (int)($modx->getOption(\'new_folder_permissions\', null, \'755\', true)));
                if (!@mkdir($thumbPath, $permissions, true)) {
                    $modx->log(MODX_LOG_LEVEL_ERROR, sprintf(\'[migxResourceMediaPath]: could not create directory %s).\', $thumbPath));
                } else {
                    chmod($thumbPath, $permissions);
                }

            }


            $filename = $filePath . $name;
            $thumbname = $thumbPath . $name;
            $ext = substr(strrchr($name, \'.\'), 1);
            if (in_array($ext, $imageExtensions)) {
                $sizes = getimagesize($filename);
                echo $sizes[0]; 
                //$format = substr($sizes[\'mime\'], 6);
                if ($sizes[0] > $rc[\'w\'] || $sizes[1] > $rc[\'h\']) {
                    if ($sizes[0] < $rc[\'w\']) {
                        $rc[\'w\'] = $sizes[0];
                    }
                    if ($sizes[1] < $rc[\'h\']) {
                        $rc[\'h\'] = $sizes[1];
                    }
                    $type = $sizes[0] > $sizes[1] ? \'landscape\' : \'portrait\';
                    if (isset($rc[\'far\']) && $rc[\'far\'] == \'1\' && isset($rc[\'w\']) && isset($rc[\'h\'])) {
                        if ($type = \'landscape\') {
                            unset($rc[\'h\']);
                        }else {
                            unset($rc[\'w\']);
                        }
                    }

                    $options = \'\';
                    foreach ($rc as $k => $v) {
                        if ($k != \'alias\') {
                            $options .= \'&\' . $k . \'=\' . $v;
                        }
                    }
                    $resized = $modx->runSnippet(\'phpthumbof\', array(\'input\' => $filePath . $name, \'options\' => $options));
                    rename(MODX_BASE_PATH . substr($resized, 1), $thumbname);
                }
            }


        }
    }
}',
      'locked' => '0',
      'properties' => 'a:0:{}',
      'disabled' => '0',
      'moduleguid' => '',
      'static' => '0',
      'static_file' => '',
    ),
    7 => 
    array (
      'id' => '7',
      'source' => '1',
      'property_preprocess' => '0',
      'name' => 'pdoTools',
      'description' => '',
      'editor_type' => '0',
      'category' => '5',
      'cache_type' => '0',
      'plugincode' => '/** @var modX $modx */
switch ($modx->event->name) {

    case \'OnMODXInit\':
        $fqn = $modx->getOption(\'pdoTools.class\', null, \'pdotools.pdotools\', true);
        $path = $modx->getOption(\'pdotools_class_path\', null, MODX_CORE_PATH . \'components/pdotools/model/\', true);
        $modx->loadClass($fqn, $path, false, true);

        $fqn = $modx->getOption(\'pdoFetch.class\', null, \'pdotools.pdofetch\', true);
        $path = $modx->getOption(\'pdofetch_class_path\', null, MODX_CORE_PATH . \'components/pdotools/model/\', true);
        $modx->loadClass($fqn, $path, false, true);
        break;

    case \'OnBeforeSaveWebPageCache\':
        if (!empty($modx->config[\'fenom_jscripts\'])) {
            foreach ($modx->config[\'fenom_jscripts\'] as $key => $value) {
                unset($modx->resource->_jscripts[$key]);
            }
            $modx->resource->_jscripts = array_values($modx->resource->_jscripts);
        }
        if (!empty($modx->config[\'fenom_sjscripts\'])) {
            foreach ($modx->config[\'fenom_sjscripts\'] as $key => $value) {
                unset($modx->resource->_sjscripts[$key]);
            }
            $modx->resource->_sjscripts = array_values($modx->resource->_sjscripts);
        }
        if (!empty($modx->config[\'fenom_loadedscripts\'])) {
            foreach ($modx->config[\'fenom_loadedscripts\'] as $key => $value) {
                unset($modx->resource->_loadedjscripts[$key]);
            }
        }
        break;

    case \'OnSiteRefresh\':
        /** @var pdoTools $pdoTools */
        if ($pdoTools = $modx->getService(\'pdoTools\')) {
            if ($pdoTools->clearFileCache()) {
                $modx->log(modX::LOG_LEVEL_INFO, $modx->lexicon(\'refresh_default\') . \': pdoTools\');
            }
        }
        break;
}',
      'locked' => '0',
      'properties' => NULL,
      'disabled' => '0',
      'moduleguid' => '',
      'static' => '0',
      'static_file' => 'core/components/pdotools/elements/plugins/plugin.pdotools.php',
    ),
    8 => 
    array (
      'id' => '8',
      'source' => '0',
      'property_preprocess' => '0',
      'name' => 'Ace',
      'description' => 'Ace code editor plugin for MODx Revolution',
      'editor_type' => '0',
      'category' => '0',
      'cache_type' => '0',
      'plugincode' => '/**
 * Ace Source Editor Plugin
 *
 * Events: OnManagerPageBeforeRender, OnRichTextEditorRegister, OnSnipFormPrerender,
 * OnTempFormPrerender, OnChunkFormPrerender, OnPluginFormPrerender,
 * OnFileCreateFormPrerender, OnFileEditFormPrerender, OnDocFormPrerender
 *
 * @author Danil Kostin <danya.postfactum(at)gmail.com>
 *
 * @package ace
 *
 * @var array $scriptProperties
 * @var Ace $ace
 */
if ($modx->event->name == \'OnRichTextEditorRegister\') {
    $modx->event->output(\'Ace\');
    return;
}

if ($modx->getOption(\'which_element_editor\', null, \'Ace\') !== \'Ace\') {
    return;
}

$ace = $modx->getService(\'ace\', \'Ace\', $modx->getOption(\'ace.core_path\', null, $modx->getOption(\'core_path\').\'components/ace/\').\'model/ace/\');
$ace->initialize();

$extensionMap = array(
    \'tpl\'   => \'text/x-smarty\',
    \'htm\'   => \'text/html\',
    \'html\'  => \'text/html\',
    \'css\'   => \'text/css\',
    \'scss\'  => \'text/x-scss\',
    \'less\'  => \'text/x-less\',
    \'svg\'   => \'image/svg+xml\',
    \'xml\'   => \'application/xml\',
    \'xsl\'   => \'application/xml\',
    \'js\'    => \'application/javascript\',
    \'json\'  => \'application/json\',
    \'php\'   => \'application/x-php\',
    \'sql\'   => \'text/x-sql\',
    \'md\'    => \'text/x-markdown\',
    \'txt\'   => \'text/plain\',
    \'twig\'  => \'text/x-twig\'
);

// Defines wether we should highlight modx tags
$modxTags = false;
switch ($modx->event->name) {
    case \'OnSnipFormPrerender\':
        $field = \'modx-snippet-snippet\';
        $mimeType = \'application/x-php\';
        break;
    case \'OnTempFormPrerender\':
        $field = \'modx-template-content\';
        $modxTags = true;

        switch (true) {
            case $modx->getOption(\'twiggy_class\'):
                $mimeType = \'text/x-twig\';
                break;
            case $modx->getOption(\'pdotools_fenom_parser\'):
                $mimeType = \'text/x-smarty\';
                break;
            default:
                $mimeType = \'text/html\';
                break;
        }

        break;
    case \'OnChunkFormPrerender\':
        $field = \'modx-chunk-snippet\';
        if ($modx->controller->chunk && $modx->controller->chunk->isStatic()) {
            $extension = pathinfo($modx->controller->chunk->getSourceFile(), PATHINFO_EXTENSION);
            $mimeType = isset($extensionMap[$extension]) ? $extensionMap[$extension] : \'text/plain\';
        } else {
            $mimeType = \'text/html\';
        }
        $modxTags = true;

        switch (true) {
            case $modx->getOption(\'twiggy_class\'):
                $mimeType = \'text/x-twig\';
                break;
            case $modx->getOption(\'pdotools_fenom_default\'):
                $mimeType = \'text/x-smarty\';
                break;
            default:
                $mimeType = \'text/html\';
                break;
        }

        break;
    case \'OnPluginFormPrerender\':
        $field = \'modx-plugin-plugincode\';
        $mimeType = \'application/x-php\';
        break;
    case \'OnFileCreateFormPrerender\':
        $field = \'modx-file-content\';
        $mimeType = \'text/plain\';
        break;
    case \'OnFileEditFormPrerender\':
        $field = \'modx-file-content\';
        $extension = pathinfo($scriptProperties[\'file\'], PATHINFO_EXTENSION);
        $mimeType = isset($extensionMap[$extension])
            ? $extensionMap[$extension]
            : \'text/plain\';
        $modxTags = $extension == \'tpl\';
        break;
    case \'OnDocFormPrerender\':
        if (!$modx->controller->resourceArray) {
            return;
        }
        $field = \'ta\';
        $mimeType = $modx->getObject(\'modContentType\', $modx->controller->resourceArray[\'content_type\'])->get(\'mime_type\');

        switch (true) {
            case $mimeType == \'text/html\' && $modx->getOption(\'twiggy_class\'):
                $mimeType = \'text/x-twig\';
                break;
            case $mimeType == \'text/html\' && $modx->getOption(\'pdotools_fenom_parser\'):
                $mimeType = \'text/x-smarty\';
                break;
        }

        if ($modx->getOption(\'use_editor\')){
            $richText = $modx->controller->resourceArray[\'richtext\'];
            $classKey = $modx->controller->resourceArray[\'class_key\'];
            if ($richText || in_array($classKey, array(\'modStaticResource\',\'modSymLink\',\'modWebLink\',\'modXMLRPCResource\'))) {
                $field = false;
            }
        }
        $modxTags = true;
        break;
    default:
        return;
}

$modxTags = (int) $modxTags;
$script = \'\';
if ($field) {
    $script .= "MODx.ux.Ace.replaceComponent(\'$field\', \'$mimeType\', $modxTags);";
}

if ($modx->event->name == \'OnDocFormPrerender\' && !$modx->getOption(\'use_editor\')) {
    $script .= "MODx.ux.Ace.replaceTextAreas(Ext.query(\'.modx-richtext\'));";
}

if ($script) {
    $modx->controller->addHtml(\'<script>Ext.onReady(function() {\' . $script . \'});</script>\');
}',
      'locked' => '0',
      'properties' => NULL,
      'disabled' => '0',
      'moduleguid' => '',
      'static' => '0',
      'static_file' => 'ace/elements/plugins/ace.plugin.php',
    ),
    16 => 
    array (
      'id' => '16',
      'source' => '0',
      'property_preprocess' => '0',
      'name' => 'Babel',
      'description' => 'Links and synchronizes multilingual resources.',
      'editor_type' => '0',
      'category' => '0',
      'cache_type' => '0',
      'plugincode' => '/**
 * Babel
 *
 * Copyright 2010 by Jakob Class <jakob.class@class-zec.de>
 *
 * This file is part of Babel.
 *
 * Babel is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Babel is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Babel; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 * @package babel
 */
/**
 * Babel Plugin to link and synchronize multilingual resources
 *
 * Based on ideas of Sylvain Aerni <enzyms@gmail.com>
 *
 * Events:
 * OnDocFormPrerender,OnDocFormSave,OnEmptyTrash,OnContextRemove,OnResourceDuplicate
 *
 * @author Jakob Class <jakob.class@class-zec.de>
 *         goldsky <goldsky@virtudraft.com>
 *
 * @package babel
 *
 */
$babel = $modx->getService(\'babel\', \'Babel\', $modx->getOption(\'babel.core_path\', null, $modx->getOption(\'core_path\').\'components/babel/\').\'model/babel/\');

/* be sure babel TV is loaded */
if (!($babel instanceof Babel) || !$babel->babelTv)
    return;

switch ($modx->event->name) {
    case \'OnDocFormPrerender\':
        $output       = \'\';
        $errorMessage = \'\';
        $resource     = & $modx->event->params[\'resource\'];
        if (!$resource) {
            /* a new resource is being to created
             * -> skip rendering the babel box */
            break;
        }
        $linkedResources = $babel->getLinkedResources($resource->get(\'id\'));
        if (empty($linkedResources)) {
            /* always be sure that the Babel TV is set */
            $babel->initBabelTv($resource);
        }

        /* create babel-box with links to translations */
        $outputLanguageItems = \'\';
        if (!$modx->lexicon) {
            $modx->getService(\'lexicon\', \'modLexicon\');
        }
        $languagesStore = array();
        $contextKeys    = $babel->getGroupContextKeys($resource->get(\'context_key\'));
        foreach ($contextKeys as $contextKey) {
            /* for each (valid/existing) context of the context group a button will be displayed */
            $context = $modx->getObject(\'modContext\', array(\'key\' => $contextKey));
            if (!$context) {
                $modx->log(modX::LOG_LEVEL_ERROR, \'Could not load context: \'.$contextKey);
                continue;
            }
            $context->prepare();
            $cultureKey       = $context->getOption(\'cultureKey\', $modx->getOption(\'cultureKey\'));
            $languagesStore[] = array($modx->lexicon(\'babel.language_\'.$cultureKey)." ($contextKey)", $contextKey);
        }

        $babel->config[\'context_key\']    = $resource->get(\'context_key\');
        $babel->config[\'languagesStore\'] = $languagesStore;
        $babel->config[\'menu\']           = $babel->getMenu($resource);
        if (empty($babel->config[\'menu\'])) {
            $modx->log(modX::LOG_LEVEL_ERROR, \'[Babel] Could not load menu for context key: "\'.$babel->config[\'context_key\'].\'". Try to check "babel.contextKeys" in System Settings. If this is intended, you can ignore this warning.\');
            return;
        }
        $version         = str_replace(\' \', \'\', $babel->config[\'version\']);
        $isCSSCompressed = $modx->getOption(\'compress_css\');
        $withVersion     = $isCSSCompressed ? \'\' : \'?v=\'.$version;
        $modx->controller->addCss($babel->config[\'cssUrl\'].\'babel.css\'.$withVersion);

        $modx->controller->addLexiconTopic(\'babel:default\');
        $isJsCompressed = $modx->getOption(\'compress_js\');
        $withVersion    = $isJsCompressed ? \'\' : \'?v=\'.$version;
        $modx->controller->addJavascript($babel->config[\'jsUrl\'].\'babel.class.js\'.$withVersion);
        $modx->controller->addHtml(\'
<script type="text/javascript">
    Ext.onReady(function () {
        var babel = new Babel(\'.json_encode($babel->config).\');
        babel.getMenu(babel.config.menu);
    });
</script>\');
        break;

    case \'OnDocFormSave\':
        $resource = & $modx->event->params[\'resource\'];
        if (!$resource) {
            $modx->log(modX::LOG_LEVEL_ERROR, \'No resource provided for OnDocFormSave event\');
            break;
        }
        if ($modx->event->params[\'mode\'] == modSystemEvent::MODE_NEW) {
            /* no TV synchronization for new resources, just init Babel TV */
            $babel->initBabelTv($resource);
            break;
        }
        $babel->synchronizeTvs($resource->get(\'id\'));
        break;

    case \'OnEmptyTrash\':
        /* remove translation links to non-existing resources */
        $deletedResourceIds = & $modx->event->params[\'ids\'];
        if (is_array($deletedResourceIds)) {
            foreach ($deletedResourceIds as $deletedResourceId) {
                $babel->removeLanguageLinksToResource($deletedResourceId);
            }
        }
        break;

    case \'OnContextRemove\':
        /* remove translation links to non-existing contexts */
        $context = & $modx->event->params[\'context\'];
        if ($context) {
            $babel->removeLanguageLinksToContext($context->get(\'key\'));
        }
        break;

    case \'OnResourceDuplicate\':
        /* init Babel TV of duplicated resources */
        $resource = & $modx->event->params[\'newResource\'];
        $babel->initBabelTvsRecursive($modx, $babel, $resource->get(\'id\'));
        break;

    case \'OnResourceSort\':
        $nodesAffected = & $modx->event->params[\'nodesAffected\'];
        foreach ($nodesAffected as $node) {
            $linkedResources = $babel->getLinkedResources($node->get(\'id\'));
            foreach ($linkedResources as $key => $id) {
                if ($id === $node->get(\'id\')) {
                    unset($linkedResources[$key]);
                }
            }
            $linkedResources[$node->get(\'context_key\')] = $node->get(\'id\');
            $babel->updateBabelTv($linkedResources, $linkedResources);
        }

        break;

    case \'OnSiteRefresh\':
        $cacheManager = $modx->getCacheManager();
        $cacheManager->refresh(array(
            \'babel\' => array(),
        ));
        break;

    default:
        break;
}
return;',
      'locked' => '0',
      'properties' => NULL,
      'disabled' => '0',
      'moduleguid' => '',
      'static' => '0',
      'static_file' => '',
    ),
    26 => 
    array (
      'id' => '26',
      'source' => '1',
      'property_preprocess' => '0',
      'name' => 'switchContext ',
      'description' => '',
      'editor_type' => '0',
      'category' => '0',
      'cache_type' => '0',
      'plugincode' => 'if($modx->context->get(\'key\') != "mgr") {
    switch ($_REQUEST[\'cultureKey\']) {
        case \'en\':
            $modx->switchContext(\'en\');
        break;
        case \'de\':
            $modx->switchContext(\'de\');
        break;
        default:
            $modx->switchContext(\'web\');
        break;
    }
    unset($_GET[\'cultureKey\']);
}',
      'locked' => '0',
      'properties' => 'a:0:{}',
      'disabled' => '0',
      'moduleguid' => '',
      'static' => '0',
      'static_file' => '',
    ),
  ),
  'policies' => 
  array (
    'modAccessContext' => 
    array (
      'web' => 
      array (
        0 => 
        array (
          'principal' => 0,
          'authority' => 9999,
          'policy' => 
          array (
            'load' => true,
          ),
        ),
        1 => 
        array (
          'principal' => 1,
          'authority' => 0,
          'policy' => 
          array (
            'about' => true,
            'access_permissions' => true,
            'actions' => true,
            'change_password' => true,
            'change_profile' => true,
            'charsets' => true,
            'class_map' => true,
            'components' => true,
            'content_types' => true,
            'countries' => true,
            'create' => true,
            'credits' => true,
            'customize_forms' => true,
            'dashboards' => true,
            'database' => true,
            'database_truncate' => true,
            'delete_category' => true,
            'delete_chunk' => true,
            'delete_context' => true,
            'delete_document' => true,
            'delete_eventlog' => true,
            'delete_plugin' => true,
            'delete_propertyset' => true,
            'delete_role' => true,
            'delete_snippet' => true,
            'delete_template' => true,
            'delete_tv' => true,
            'delete_user' => true,
            'directory_chmod' => true,
            'directory_create' => true,
            'directory_list' => true,
            'directory_remove' => true,
            'directory_update' => true,
            'edit_category' => true,
            'edit_chunk' => true,
            'edit_context' => true,
            'edit_document' => true,
            'edit_locked' => true,
            'edit_plugin' => true,
            'edit_propertyset' => true,
            'edit_role' => true,
            'edit_snippet' => true,
            'edit_template' => true,
            'edit_tv' => true,
            'edit_user' => true,
            'element_tree' => true,
            'empty_cache' => true,
            'error_log_erase' => true,
            'error_log_view' => true,
            'events' => true,
            'export_static' => true,
            'file_create' => true,
            'file_list' => true,
            'file_manager' => true,
            'file_remove' => true,
            'file_tree' => true,
            'file_update' => true,
            'file_upload' => true,
            'file_unpack' => true,
            'file_view' => true,
            'flush_sessions' => true,
            'frames' => true,
            'help' => true,
            'home' => true,
            'import_static' => true,
            'languages' => true,
            'lexicons' => true,
            'list' => true,
            'load' => true,
            'logout' => true,
            'logs' => true,
            'menus' => true,
            'menu_reports' => true,
            'menu_security' => true,
            'menu_site' => true,
            'menu_support' => true,
            'menu_system' => true,
            'menu_tools' => true,
            'menu_user' => true,
            'messages' => true,
            'namespaces' => true,
            'new_category' => true,
            'new_chunk' => true,
            'new_context' => true,
            'new_document' => true,
            'new_document_in_root' => true,
            'new_plugin' => true,
            'new_propertyset' => true,
            'new_role' => true,
            'new_snippet' => true,
            'new_static_resource' => true,
            'new_symlink' => true,
            'new_template' => true,
            'new_tv' => true,
            'new_user' => true,
            'new_weblink' => true,
            'packages' => true,
            'policy_delete' => true,
            'policy_edit' => true,
            'policy_new' => true,
            'policy_save' => true,
            'policy_template_delete' => true,
            'policy_template_edit' => true,
            'policy_template_new' => true,
            'policy_template_save' => true,
            'policy_template_view' => true,
            'policy_view' => true,
            'property_sets' => true,
            'providers' => true,
            'publish_document' => true,
            'purge_deleted' => true,
            'remove' => true,
            'remove_locks' => true,
            'resource_duplicate' => true,
            'resourcegroup_delete' => true,
            'resourcegroup_edit' => true,
            'resourcegroup_new' => true,
            'resourcegroup_resource_edit' => true,
            'resourcegroup_resource_list' => true,
            'resourcegroup_save' => true,
            'resourcegroup_view' => true,
            'resource_quick_create' => true,
            'resource_quick_update' => true,
            'resource_tree' => true,
            'save' => true,
            'save_category' => true,
            'save_chunk' => true,
            'save_context' => true,
            'save_document' => true,
            'save_plugin' => true,
            'save_propertyset' => true,
            'save_role' => true,
            'save_snippet' => true,
            'save_template' => true,
            'save_tv' => true,
            'save_user' => true,
            'search' => true,
            'settings' => true,
            'sources' => true,
            'source_delete' => true,
            'source_edit' => true,
            'source_save' => true,
            'source_view' => true,
            'steal_locks' => true,
            'tree_show_element_ids' => true,
            'tree_show_resource_ids' => true,
            'undelete_document' => true,
            'unlock_element_properties' => true,
            'unpublish_document' => true,
            'usergroup_delete' => true,
            'usergroup_edit' => true,
            'usergroup_new' => true,
            'usergroup_save' => true,
            'usergroup_user_edit' => true,
            'usergroup_user_list' => true,
            'usergroup_view' => true,
            'view' => true,
            'view_category' => true,
            'view_chunk' => true,
            'view_context' => true,
            'view_document' => true,
            'view_element' => true,
            'view_eventlog' => true,
            'view_offline' => true,
            'view_plugin' => true,
            'view_propertyset' => true,
            'view_role' => true,
            'view_snippet' => true,
            'view_sysinfo' => true,
            'view_template' => true,
            'view_tv' => true,
            'view_unpublished' => true,
            'view_user' => true,
            'workspaces' => true,
          ),
        ),
      ),
    ),
  ),
);