<?php
/**
 * plugin-name
 */
namespace PluginMainNamespace;

final class Main
{

    private $dir;
    private $url;
    private $wpdb;
    private $admin_page;

    public function __construct(string $dir, string $url)
    {
        
        global $wpdb;

        $this->wpdb = $wpdb;

        $this->dir = $dir;
        $this->url = $url;

        $this->admin_page = 'foldername-admin.php';

    }

}
