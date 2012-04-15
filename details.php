<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Sitemappy extends Module {

	public $version = '1.0';
	
	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Sitemappy',
				'ru' => 'Карта сайта'
			),
			'description' => array(
				'en' => '- no description -',
				'ru' => 'Модуль для отображения карты сайта',
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu' => 'content',
		    'shortcuts' => array(
				array(
					'name' => 'sitemappy.disable_page',
					'uri'  => 'admin/sitemappy/disable',
					'class' => 'del'
				)
			),
		);
	}

	public function install()
	{
		/*
		* Добавляем таблицу для отключенных страниц
		*/
		$this->dbforge->add_field(array(
			'page_id' => array(
				'type' => 'INT',
				'unsigned' => true,
				'constraint' => 11
			)
		));
		
		if(!$this->dbforge->create_table('sitemappy_disable_pages')){
			return false;
		}
		/*
		* Предположим, что у нас INNODB таблицы, тобишь работают норм внешние ключи
		*/
		$this->db->query('CREATE UNIQUE INDEX idx_page_id ON `'.$this->db->dbprefix('sitemappy_disable_pages').'`(page_id)');
		$this->db->query('ALTER TABLE `'.$this->db->dbprefix('sitemappy_disable_pages').'` ADD FOREIGN KEY (`page_id`) REFERENCES `'.$this->db->dbprefix('pages').'`(id) ON DELETE CASCADE ON UPDATE CASCADE');
		return true;	
	}
	public function uninstall()
	{
		$this->dbforge->drop_table('sitemappy_disable_pages');
		return TRUE;
	}


	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}

	public function help()
	{
		// Return a string containing help info
		// You could include a file and return it here.
		return "Help sitemappy";
	}
}
/* End of file details.php */