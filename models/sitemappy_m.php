<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 *
 * @license 	Apache License v2.0
 */
class Sitemappy_m extends MY_Model {

	public function __construct(){
		
		parent::__construct();
		
		$this->set_table_name('sitemappy_disable_pages');
		$this->primary_key = 'page_id';
	}
	
	public function insert($data=array()){
		$available_data = array('page_id');
		$data = array_intersect_key($data,array_flip($available_data));
		return parent::insert($data);
	}
}