<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller
{

	private $disable_validation_rules = array(
		array('field' => 'page_id', 'label'=>'sitemappy.page_id', 'rules'=>'required|is_natural|callback_check_page_id')
	);
	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('sitemappy_m');
		$this->load->library('form_validation');
		$this->lang->load('sitemappy');
		
		$this->load->helper('html');
		$this->load->model('pages/page_m');
	}

	/**
	 * List all disable pages
	 *
	 * @access public
	 * @return void
	 */
	public function index()
	{
		$disable_pages = $this->sitemappy_m->get_all();

		// Load the view
		$this->template
			->title($this->module_details['name'])
			->set('disable_pages',$disable_pages)
			->build('admin/index');
	}

	/**
	 * disable a page
	 *
	 * @access public
	 * @return void
	 */
	public function available($page_id)
	{
		$this->sitemappy_m->delete($page_id);
		
		$disable_pages = $this->sitemappy_m->get_all();
		$this->template
			->title($this->module_details['name'], lang('sitemappy.disable_page_label'))
			->set('disable_pages',$disable_pages)
			->build('admin/index');
	}
	
	public function disable(){
	
		$all_disable_pages = $this->sitemappy_m->get_all();
		$all_pages = $this->page_m->get_all();
		$select_pages = array();
		
		$ids_disable_pages = array();
		foreach($all_disable_pages as $disable_page){
			$ids_disable_pages[] = $disable_page->page_id;
		}
		
		foreach($all_pages as $page){
			if(!in_array($page->id,$ids_disable_pages))$select_pages[$page->id] = $page->slug;
		}
		// Set the validation rules
		$this->form_validation->set_rules($this->disable_validation_rules);

		if ($this->form_validation->run() )
		{
			$this->sitemappy_m->insert($this->input->post());
			// Everything went ok..
			$this->session->set_flashdata('success', lang('sitemappy.create_success'));

			// Redirect back to the form or main page
			$this->input->post('btnAction') == 'save_exit'
				? redirect('admin/sitemappy')
				: redirect('admin/sitemappy/disable');
		}

		$this->template
			->title($this->module_details['name'], lang('sitemappy.disable_page_label'))
			->set('pages',$select_pages)
			->build('admin/disable');	
	}
	/**
	 * @return bool
	 */
	public function check_page_id($id = 0)
	{
		return true;
	}
}
