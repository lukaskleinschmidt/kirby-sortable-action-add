<?php
// Make sure that the sortable plugin is loaded
$kirby->plugin('sortable');
if(!function_exists('sortable')) return;

sortable()->set('action',  'add', __DIR__ . DS . 'add');
