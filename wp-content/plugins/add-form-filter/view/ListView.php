<?php

class ListView extends WP_List_Table
{
	public function prepare_items() {
		$columns = $this->get_columns();
		$hidden = $this->get_hidden_columns();
		$sortable = $this->get_sortable_columns();
		
		$data = $this->table_data();
		
		if (isset($_POST['s'])) {
			$data = $this->search($data, $_POST['s']);
		}
		
		usort( $data, array( $this, 'sort_data' ) );
		
		$perPage = 5;
		$currentPage = $this->get_pagenum();
		$totalItems = count($data);
		
		$this->set_pagination_args( array(
				'total_items' => $totalItems,
				'per_page'    => $perPage
		) );
		
		$data = array_slice($data,(($currentPage-1)*$perPage),$perPage);
		
		$this->_column_headers = array($columns, $hidden, $sortable);
		$this->items = $data;
	}
	
	public function get_columns() {
		$columns = array(
				'id'		=> 'Id',
				'name'		=> 'Nom',
				'is_actif'	=> 'Actif',
				'actions'	=> 'Actions'
		);
	
		return $columns;
	}
	
	public function get_hidden_columns() {
		return array();
	}
	
	public function get_sortable_columns() {
		return array('id' => array('id', false), 'name' => array('name', false), 'is_actif' => array('is_actif', false));
	}
	
	public function column_default( $item, $column_name ) {
		switch( $column_name ) {
			case 'id':
			case 'name':
			case 'is_actif':
			case 'actions':
				return $item[ $column_name ];
	
			default:
				return print_r( $item, true ) ;
		}
	}
	
	private function table_data() {
		global $wpdb;
		$data = array();
		
		// Récupération des filtres existants
		$filtres = $wpdb->get_results("SELECT * FROM ".AddFormFilter::DATABASE_PREFIX.AddFormFilter::TABLE_NAME_FILTER, "ARRAY_A");
		
		foreach ($filtres as $filtre) {
			$actif = 'Non';
			$actions = sprintf('<a href="?page=%s&action=%s&id=%s">Edit</a>',$_REQUEST['page'],'edit',$filtre['id']).' '.
					   sprintf('<a href="?page=%s&action=%s&id=%s">Delete</a>',$_REQUEST['page'],'delete',$filtre['id']);
			
			if ($filtre['is_actif'] > 0) {
				$actif = 'Oui';
			} else {
				$actions .= ' '.sprintf('<a href="?page=%s&action=%s&id=%s">Actif</a>',$_REQUEST['page'],'is_actif',$filtre['id']);
			}
			
			
			
			$data[] = array(
					'id'		=> $filtre['id'],
					'name'		=> $filtre['name'],
					'is_actif'	=> $actif,
					'actions'	=> $actions
			);
		}
		
		return $data;
	}
	
	private function sort_data($a, $b) {
		$orderby = 'id';
		$order = 'asc';
		
		if(!empty($_GET['orderby'])) {
			$orderby = $_GET['orderby'];
		}
	
		if(!empty($_GET['order'])) {
			$order = $_GET['order'];
		}
		
		$result = strnatcasecmp( $a[$orderby], $b[$orderby] );
	
		if($order === 'asc') {
			return $result;
		}
	
		return -$result;
	}
	
	private function search($data, $search) {
		$result = array();
		
		foreach ($data as $raw) {
			if (preg_match("/".$search."/", $raw['name']))
				$result[] = $raw;
		}
		
		return $result;
	}
}