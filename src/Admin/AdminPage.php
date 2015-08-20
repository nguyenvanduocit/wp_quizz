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
 * Class AdminPage
 * The class to generateAdminPage
 *
 * @since   1.0.0
 * @access (private, protected, or public)
 * @package SearchTerm\Admin
 */
class AdminPage extends \scbAdminPage{
	function setup() {
		$this->args = array(
			'page_title' => 'scb Example',
		);
	}

	function page_content() {
		echo html( 'p', 'Hello World!' );
	}
}