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

namespace WPQuizz\Admin;


/**
 * Class Admin
 * class are responsible for coordinating the admin module
 *
 * @since   1.0.0
 * @access (private, protected, or public)
 * @package SearchTerm\Admin
 */
class Admin {
	protected $adminPage;
	public function init(){

	}
	public function run(){
		$this->adminPage = new AdminPage(ST_FILE);
	}
}