<?php
/**
 * @package Admin Bar
 */
/*
Plugin Name: Admin Bar
Plugin URI: http://tsvang.net.ua
Description: Enable or disable Frontend Admin Bar in wordpress 3.1
Version: 1.0
Author: Vladimir Tsvang
Author URI: http://tsvang.net.ua
License: GPLv2 or later
*/
class AdminBar {
    var $pluginUrl;

    function AdminBar() {
        if(! is_admin()) {
            if(! (bool) get_option('show-ab')) {
                add_action('show_admin_bar', '__return_false');
            }
        } else {
            $this->pluginUrl = WP_PLUGIN_URL.'/'.dirname(plugin_basename(__FILE__));
            $this->LoadTextDomain();
            add_action('wp_ajax_update_form', array(&$this, 'UpdateForm'));
            add_action('admin_menu', array(&$this,'MenuPagesInit'));
            add_action('admin_init',array(&$this,'Attachments'));
        }
    }

    function MenuPagesInit() {
        add_submenu_page('themes.php', __('Admin Bar','ab'), __('Admin Bar','ab'), 'administrator', 'admin-bar', array(&$this,'AdminPage'));
    }

    function Attachments() {
        wp_register_script('admin-bar-plugin', $this->pluginUrl.'/js/admin-bar.js', array('jquery-form'));
        wp_enqueue_script('admin-bar-plugin');

        wp_register_style('admin-bar-plugin', $this->pluginUrl.'/css/admin-bar.css');
        wp_enqueue_style('admin-bar-plugin');
    }
    function AdminPage() {
        $option = get_option('show-ab');
?>
<div class="wrap">
    <div class="updated" id="ab-update"></div>
    <div id="icon-tools" class="icon32"><br /></div>
    <h2><?php _e('Admin Bar','ab'); ?></h2>
        <div class="ab-content">
            <form id="ab-form" action="" method="post">
                <ul class="ab-form-controlls">
                    <li>
                        <label for="ab-show" class="ab-control-title"><?php _e('Show Admin Bar in frontend'); ?></label>
                        <input value="1" class="checkbox" type="checkbox" name="ab-show" <?php echo (( (bool) $option===true)? 'checked' : null); ?> />
                    </li>
                </ul>
                <input type="hidden" name="action" value="update_form" />
                <input type="submit" class="button-primary alignleft" value="Save" />
            </form>
        </div>
</div>
<?php
    }

    function UpdateForm() {
        if(isset($_POST['ab-show']) && $_POST['ab-show']==1) {
            update_option('show-ab', true);
        } else {
            update_option('show-ab', false);
        }
        _e('Option saved!','ab');
        die();
    }

    function LoadTextDomain() {
        $currentLocale = get_locale();
        if(!empty($currentLocale)) {
            $moFile = $this->pluginUrl."/lang/".$currentLocale.".mo";
            if(@file_exists($moFile) && is_readable($moFile))
                load_textdomain('ab', $moFile);
        }
    }
}
$GLOBALS['admin-bar'] = new AdminBar();