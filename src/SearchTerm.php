<?php
/**
 * Summary
 * Description.
 *
 * @since  1.0.0
 * @package
 * @subpackage
 * @author nguyenvanduocit
 */

namespace SearchTerm;
use SearchTerm\Admin\Admin;
use SearchTerm\Admin\AdminPage;


/**
 * Class Searchterm
 * This is the main class, use to control all module in the plugin
 *
 * @package Searchterm
 * @since   1.0.0
 * @access (private, protected, or public)
 */
class SearchTerm {
	protected $moduleList;
	protected $admin;
	/**
	 * the construct
	 */
	public function __construct()
	{
		$this->moduleList = apply_filters('st_module_list', array(
			''
		));
	}

	/**
	 * init the plugin and its modules.
	 *
	 * @since  1.0.0
	 * @see
	 * @return void
	 * @author nguyenvanduocit
	 */
	public function init()
	{

	}

	/**
	 * Run the plugin and its module.
	 *
	 * @since  1.0.0
	 * @see
	 * @return void
	 * @author nguyenvanduocit
	 */
	public function run()
	{
		if(is_admin()){
			$this->admin = new Admin();
			$this->admin->run();
		}
	}
}