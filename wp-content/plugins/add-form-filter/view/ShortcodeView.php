<?php

class ShortcodeView
{
	public function __construct() {
		add_shortcode('add_form_filter_diplay_filter', array($this, 'diplayFilter'));
	}
	
	public function diplayFilter($att, $content) {
		
	}
}