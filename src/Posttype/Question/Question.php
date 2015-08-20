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

namespace WPQuizz\Posttype\Question;


use WPQuizz\Posttype\Base;

class Question extends Base{
	public function register(){
		$labels = array(
			'name'               => _x( 'Questions', 'post type general name', 'wpq-domain' ),
			'singular_name'      => _x( 'Question', 'post type singular name', 'wpq-domain' ),
			'menu_name'          => _x( 'Questions', 'admin menu', 'wpq-domain' ),
			'name_admin_bar'     => _x( 'Question', 'add new on admin bar', 'wpq-domain' ),
			'add_new'            => _x( 'Add New', 'question', 'wpq-domain' ),
			'add_new_item'       => __( 'Add New Question', 'wpq-domain' ),
			'new_item'           => __( 'New Question', 'wpq-domain' ),
			'edit_item'          => __( 'Edit Question', 'wpq-domain' ),
			'view_item'          => __( 'View Question', 'wpq-domain' ),
			'all_items'          => __( 'All Questions', 'wpq-domain' ),
			'search_items'       => __( 'Search Questions', 'wpq-domain' ),
			'parent_item_colon'  => __( 'Parent Questions:', 'wpq-domain' ),
			'not_found'          => __( 'No Questions found.', 'wpq-domain' ),
			'not_found_in_trash' => __( 'No Questions found in Trash.', 'wpq-domain' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'wpq-domain' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'question' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields' )
		);
		register_post_type( 'question', $args );
		$this->registerTaxonomy();
	}
	public function registerTaxonomy(){
		$labels = array(
			'name'              => _x( 'Test', 'taxonomy general name' ),
			'singular_name'     => _x( 'Test', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Test' ),
			'all_items'         => __( 'All Test' ),
			'parent_item'       => __( 'Parent Test' ),
			'parent_item_colon' => __( 'Parent Test:' ),
			'edit_item'         => __( 'Edit Test' ),
			'update_item'       => __( 'Update Test' ),
			'add_new_item'      => __( 'Add New Test' ),
			'new_item_name'     => __( 'New Test Name' ),
			'menu_name'         => __( 'Test')
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'test' ),
		);

		register_taxonomy( 'test', array( 'question' ), $args );
	}

	public function registerMetabox(){
		$post_type   = 'question';
		$meta_box_id = $post_type . "_metabox";
		$title       = 'Meta';
		$arg         = array(
			'post_type' => $post_type,
			'context'   => 'advanced',
			'priority'  => 'default',
		);
		$input       = array(
			array(
				'title' => __( 'Answer', '' ),
				'type'  => 'text',
				'name'  => '_answer'
			),
			array(
				'title' => __( 'Choice', '' ),
				'type'  => 'multi',
				'name'  => '_choices'
			)

		);
		new \scbPostMetabox( $meta_box_id, $title, $arg, $input );
	}
}