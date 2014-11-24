<?php
/*
Plugin Name: Add Form Filter
Description: Add a form to your Wordpress website.
Version: 0.1
*/

require_once 'model/AddFormFilter.php';
require_once 'model/Filtre.php';
require_once 'model/Champ.php';
require_once 'model/AdministrationAjax.php';
require_once 'controller/AdministrationController.php';
require_once 'view/AdministrationView.php';
require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
require_once 'view/ListView.php';
require_once 'view/ShortcodeView.php';
require_once 'view/FiltreView.php';

$plugin = new AddFormFilter();

