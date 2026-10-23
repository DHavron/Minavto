<?php
if($modx->context->get('key') != "mgr") {
    switch ($_REQUEST['cultureKey']) {
        case 'en':
            $modx->switchContext('en');
        break;
        case 'de':
            $modx->switchContext('de');
        break;
        default:
            $modx->switchContext('web');
        break;
    }
    unset($_GET['cultureKey']);
}
return;
