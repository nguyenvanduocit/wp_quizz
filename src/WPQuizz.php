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

namespace WPQuizz;
use WPQuizz\Admin\Admin;

/**
 * Class Searchterm
 * This is the main class, use to control all module in the plugin
 *
 * @package Searchterm
 * @since   1.0.0
 * @access (private, protected, or public)
 */
class WPQuizz {
	protected $moduleList;
	protected $postTypeList;
	protected $admin;
	/**
	 * the construct
	 */
	public function __construct()
	{
		$this->moduleList = apply_filters('wpq_module_list', array(
			'\WPQuizz\Module\ChromeIntegration\ChromeIntegration',
			'\WPQuizz\Module\SlackBotIntegration\SlackBotIntegration'
		));
		$this->postTypeList = apply_filters('wpq_module_list', array(
			'\WPQuizz\Posttype\Question\Question'
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
		foreach($this->moduleList as $moduleName){
			if(class_exists($moduleName)){
				/** @var \WPQuizz\Module\Base $loadedModule */
				$loadedModule = new $moduleName();
				$loadedModule->run();
			}
		}
		add_action('init', array($this, 'registerPosttype'));

	}
	public function registerPosttype(){
		foreach($this->postTypeList as $postTypeClassName){
			if(class_exists($postTypeClassName)){
				/** @var \WPQuizz\Posttype\Base $loadedClass */
				$loadedClass = new $postTypeClassName();
				$loadedClass->register();
			}
		}
	}
}