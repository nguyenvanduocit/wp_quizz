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

namespace WPQuizz\Module\SlackBotIntegration;


use WPQuizz\Module\Base;

class SlackBotIntegration extends Base{

	public function run() {
		add_action( 'wp_ajax_wpq-slack-get-question', array( $this, 'getQuestion' ) );
		add_action( 'wp_ajax_nopriv_wpq-slack-get-question', array( $this, 'getQuestion' ) );

		add_action( 'wp_ajax_wpq-slack-get-test', array( $this, 'getTestList' ) );
		add_action( 'wp_ajax_nopriv_wpq-slack-get-test', array( $this, 'getTestList' ) );

		add_action( 'wp_ajax_wpq-slack-get-question', array( $this, 'getQuestion' ) );
		add_action( 'wp_ajax_nopriv_wpq-slack-get-question', array( $this, 'getQuestion' ) );
	}
	public function getQuestion(){
		header( 'Access-Control-Allow-Origin: *' );
		if(!isset($_POST['category'], $_POST['method'])){
			wp_send_json(array('success'=>FALSE, 'message'=>'You have to provice the category slig'));
		}
		$category = $_POST['category'];
		$method = $_POST['method'];
		$args = array(
			'posts_per_page' => 1,
			'post_type'=>'question',
			'tax_query' => array(
				array(
					'taxonomy' => 'test',
					'field' => 'slug',
					'terms' => $category
				)
			)
		);
		if($method === 'random'){
			$args['orderby'] = 'rand';
		}
		$posts = get_posts( $args );
		if(!empty($posts)){
			$post = $posts[0];
			$choices = maybe_unserialize(get_post_meta($post->ID, WPQ_METAKEY_CHOICES, true));
			$answer = maybe_unserialize(get_post_meta($post->ID, WPQ_METAKEY_ANSWER, true));
			$answer = htmlspecialchars_decode(html_entity_decode($answer));
			foreach($choices as $index => &$choice){
				$choice = htmlspecialchars_decode(html_entity_decode($choice));
			}
			wp_send_json(array(
				             'success'=>TRUE,
				             'data'=>array(
					             'question'=>htmlspecialchars_decode(html_entity_decode($post->post_content)),
					             'choices'=>$choices,
					             'answer'=>$answer
				             )));
		}
	}

	/**
	 * Get the list of test term.
	 *
	 * @since  1.0.0
	 *
	 * @see
	 * @return void
	 *
	 * @author nguyenvanduocit
	 */
	public function getTestList(){
		header( 'Access-Control-Allow-Origin: *' );
		$taxonomies = 'test';

		$args = array(
			'orderby'           => 'name',
			'order'             => 'ASC',
			'hide_empty'        => true,
			'fields'            => 'all',
			'pad_counts'        => false
		);
		$terms = get_terms($taxonomies, $args);
		if(is_wp_error($terms)){
			wp_send_json(array('success'=>FALSE, 'message'=>$terms->get_error_message()));
		}
		wp_send_json(array('success'=>true, 'data'=>$terms));
	}
}