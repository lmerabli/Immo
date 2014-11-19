<?php

class AdministrationAjax
{
	public function dragAndDrop() {
		$_SESSION['add_form_filter']['drag_and_drop_list_items'] = $_POST['list_items'];
	}
}