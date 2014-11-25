<?php

class AdministrationAjax
{
	public function dragAndDrop() {
		$_SESSION['add_form_filter']['drag_and_drop_list_items'] = $_POST['list_items'];
	}
	
	public function deleteItemList() {
		unset($_SESSION['add_form_filter']['current_fields'][$_POST['id']]);
		
		if ($_POST['delete_drag_and_drop']) {
			$key = array_search($_POST['id'], $_SESSION['add_form_filter']['drag_and_drop_list_items']);
			
			unset($_SESSION['add_form_filter']['drag_and_drop_list_items'][$key]);
		}
	}
}