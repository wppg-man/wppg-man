<?php
/**
 * Plugin Name: plugin-name
 * Plugin URI: plugin-uri
 * Description: plugin-desc
 * Version: 0.0.1
 * Author: pulgin-author
 * Author URI: plugin-autho-uri
 */
use PluginMainNamespace\Main;

require_once __DIR__.'/foldername-autoload.php';

new Main(
    plugin_dir_path(__FILE__),
    plugin_dir_url(__FILE__)
);
