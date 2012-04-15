<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class Sitemappy extends Public_Controller
{
	/**
	 */
	public function __construct()
	{
		parent::__construct();
		
		// Load the required classes
		$this->load->model('sitemappy_m');
		$this->load->model('pages/page_m');
		$this->load->language('sitemappy');
		$this->load->helper('html');
	}
	
	/**
	 * Index method
	 *
	 * @access public
	 * @return void
	 */
	public function index()
	{
		$all_disables_pages = $this->sitemappy_m->get_all();
		$ids_disables_pages = array();
		foreach($all_disables_pages as $disable_page){
			$ids_disables_pages[] = $disable_page->page_id;
		}
		$tree_pages         = $this->page_m->get_page_tree();
		$tree_pages = $this->exclude_parse_pages($ids_disables_pages,$tree_pages,"");
		$this->template
			->title($this->module_details['name'])
			->build('index', array('pages'=>$tree_pages));
	}
	
	/*
	* Удаляем заблокированные страницы, а также парзим дерево.
	*/
	private function exclude_parse_pages(&$disable_pages,&$tree_pages,$parent_slug){
		$new_tree_pages = array();
		foreach($tree_pages as $k=>$branch_page){
			$field = $branch_page['title'];
			$page  = $this->page_m->get($branch_page['id']);
			if(in_array($branch_page['id'],$disable_pages)){
				unset($tree_pages[$k]);
			}else if(!empty($branch_page['children'])){
				
				$new_tree_pages[anchor("$page->slug",$field)] = $this->exclude_parse_pages($disable_pages,$branch_page['children'],$parent_slug."/".$page->slug);
			}else{
				$new_tree_pages[] = anchor($parent_slug."/$page->slug",$field);
			}
		}
		return $new_tree_pages;
	}

}