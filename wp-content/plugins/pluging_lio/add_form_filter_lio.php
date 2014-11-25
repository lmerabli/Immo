<?php
include_once plugin_dir_path( __FILE__ ).'/add_form_filter_widget.php';
/////////rendre le widget  visible dans la liste proposée par WordPress
class Zero_Newsletter
{
    public function __construct()
    {
        add_action('widgets_init', function(){register_widget('add_form_filter_widget');});
    }
}