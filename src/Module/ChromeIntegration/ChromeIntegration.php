<?php
namespace WPQuizz\Module\ChromeIntegration;

use WPQuizz\Factory\QuestionFactory;
use WPQuizz\Module\Base;
/**
 * Class API
 * Summary
 *
 * @since   1.0.0
 * @access (private, protected, or public)
 * @package WPQuizz\API
 */
class ChromeIntegration extends Base {

	public function run() {
		/**
		 * Add ajax to add new question
		 */
		add_action( 'wp_ajax_wpq-add-question', array( $this, 'addQuestion' ) );
		add_action( 'wp_ajax_nopriv_wpq-add-question', array( $this, 'addQuestion' ) );
	}

	public function addQuestion() {
		header( 'Access-Control-Allow-Origin: *' );
		$question           = QuestionFactory::createFromArray( $_POST );
		if ( is_wp_error( $question ) ) {
			wp_send_json( array(
				              'success' => FALSE,
				              'message' => $question->get_error_message()
			              )
			);
		} else {
			if ( QuestionFactory::isExist($question) ) {
				/**
				 * This questtion is exist
				 */
				wp_send_json( array(
					              'success' => FALSE,
					              'message' => 'This question is exist.'
				              ) );
			} else {
				/**
				 * This question is not exist
				 */
				$result = QuestionFactory::save( $question );
				if ( is_wp_error( $result ) ) {
					wp_send_json( array(
						              'success' => FALSE,
						              'message' => $result->get_error_message()
					              )
					);
				} else {
					wp_send_json( array(
						              'success' => TRUE,
						              'message' => 'Insert success',
						              'data'    => $result
					              ) );
				}
			}
		}
	}
}