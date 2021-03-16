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
    private $admin_notice;

    public function __construct(string $dir, string $url)
    {
        
        global $wpdb;

        $this->wpdb = $wpdb;

        $this->dir = $dir;
        $this->url = $url;

        $this->admin_page = 'foldername-admin.php';

        $this->adminPageAdd();

        if (strpos($_SERVER['REQUEST_URI'], 'wp-admin') !== false &&
            $_GET['page'] === $this->admin_page) {
                
            $this->adminPageTreat()
                ->adminPageData()
                ->adminPageResources();
            
        }

    }

    /**
     * Add admin pages.
     * 
     * @return $this
     */
    private function adminPageAdd() : Main
    {

        add_action('admin_menu', function() {

            add_menu_page(
                'plugin-name',
                'plugin-name',
                8,
                $this->dir.$this->admin_page
            );

            /** Add more add_menu_page() if you need for. */

        });

        return $this;

    }

    /**
     * Process what is happening at admin pages.
     * 
     * @return $this
     */
    private function adminPageTreat() : Main
    {

        add_action('plugins_loaded', function() {

            /**
             * This should be the implementation of the processing logic.
             * 
             * This should be done on the 'plugins_loaded' hook
             * due to the posibility of pluggable functions use
             * like wp_verify_nonce() for example.
             */

        });

        return $this;

    }

    /**
     * Use of admin page filters.
     * 
     * @return $this
     */
    private function adminPageData() : Main
    {

        /**
         * Basic filter example.
         * Replace it if you need for, or add more filters,
         * but don't forget to do it in admin page code too.
         */
        add_filter('wppg-man-filter', function($content) {

            ob_start();

?>
<p class="text-centered">Rise and shine!</p>
<?php

            return ob_get_clean();

        });

        return $this;

    }

    /**
     * Add CSS and JS files to admin pages.
     * 
     * @return $this
     */
    private function adminPageResources() : Main
    {

        add_action('admin_enqueue_scripts', function() {

            wp_enqueue_style(
                'foldername-admin',
                $this->url.'css/admin.css',
                [],
                '0.0.1'
            );

            wp_enqueue_script(
                'foldername-admin',
                $this->url.'js/admin.js',
                [],
                '0.0.1'
            );

        });

        return $this;

    }

    /**
     * Set new admin page notice.
     * 
     * @param string $type
     * Notice type.
     * Might be 'success', 'warning' or 'error'/'danger'.
     * 
     * @param string $text
     * Notice text.
     * 
     * @return $this
     */
    private function adminPageNotice(string $type, string $text) : Main
    {

        if ($type === 'danger') $type = 'error';

        $this->admin_notice = [
            'type' => $type,
            'text' => $text
        ];

        add_action('admin_notices', function($prev_notices) {

            ob_start();

?>
<div class="notice notice-<?= htmlspecialchars($this->admin_notice['type']) ?> is-dismissible width-limit-500 elem-centered">
    <p class="text-centered"><?= $this->admin_notice['text'] ?></p>
</div>
<?php

            echo $prev_notices.ob_get_clean();

        });

        return $this;

    }

}
