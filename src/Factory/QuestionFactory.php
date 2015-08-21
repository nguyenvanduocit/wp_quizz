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

namespace WPQuizz\Factory;


use WPQuizz\Model\Question;

/**
 * Class QuestionFactory
 * Summary
 *
 * @since   1.0.0
 * @access (private, protected, or public)
 * @package WPQuizz\Factory
 */
class QuestionFactory {
	/**
	 * Summary.
	 *
	 * @since  1.0.0
	 * @see
	 * @return \WPQuizz\Model\Question|\WP_Error
	 * @author nguyenvanduocit
	 */
	public static function create( $data ) {
		if ( is_numeric( $data ) ) {
			return static::createFromPostId( $data );
		}
		if ( is_array( $data ) ) {
			return static::createFromArray( $data );
		}

		return NULL;
	}

	/**
	 * Summary.
	 *
	 * @since  1.0.0
	 * @see
	 *
	 * @param $question \WPQuizz\Model\Question
	 *
	 * @return bool
	 * @author nguyenvanduocit
	 */
	public static function isExist( $question ) {
		global $wpdb;
		$query = $wpdb->prepare( "SELECT COUNT(1) FROM {$wpdb->posts} question WHERE question.post_type = %s AND question.post_name = %s",
		                         'question',
		                         md5($question->getQuestion()) );
		return $wpdb->get_var( $query ) > 0;
	}

	/**
	 * Summary.
	 *
	 * @since  1.0.0
	 * @see
	 *
	 * @param $data
	 *
	 * @return \WPQuizz\Model\Question|\WP_Error
	 * @author nguyenvanduocit
	 */
	public static function createFromArray( $data ) {
		if ( ! isset( $data[ 'answer' ], $data[ 'question' ], $data[ 'choices' ], $data[ 'difficulty' ], $data[ 'percent_correct' ], $data[ 'percent_incorrect' ], $data[ 'category' ] ) ) {
			return new \WP_Error( 'DATA_IS_NOT_VALID', 'This data is not valid' );
		}
		$question = new Question();
		$question->setQuestion( $data[ 'question' ] );
		$question->setCategory( $data[ 'category' ] );
		$question->setChoices( $data[ 'choices' ] );
		$question->setAnswer( $data[ 'answer' ] );
		$question->setDifficulty( $data[ 'difficulty' ] );
		$question->setPercentCorrect( $data[ 'percent_correct' ] );
		$question->setPercentIncorrect( $data[ 'percent_incorrect' ] );
		$question->setSmartererId( $data[ 'question_id' ] );
		$question->setTotalResponses( $data[ 'total_responses' ] );

		return $question;
	}

	/**
	 * Summary.
	 *
	 * @since  1.0.0
	 * @see
	 *
	 * @param $postid
	 *
	 * @return \WPQuizz\Model\Question|\WP_Error
	 * @author nguyenvanduocit
	 */
	public static function createFromPostId( $postId ) {
		if($postId instanceof \WP_Post){
			$post = $postId;
		}
		else{
			$post = get_post( $postId );
		}
		if ( ! $postId ) {
			return new \WP_Error( 'NOT_FOUND', 'This post is not exist.' );
		}

		$question = new Question();
		$question->setQuestion( $post->post_title );
		$question->setCategory( wp_get_object_terms( $post->ID,'test', array( 'fields' => 'slugs' ) ) );

		$choices = get_post_meta( $post->ID, WPQ_METAKEY_CHOICES, TRUE );
		$question->setChoices( maybe_unserialize( $choices ) );

		$answer = get_post_meta( $post->ID, WPQ_METAKEY_ANSWER, TRUE );
		$question->setAnswer( $answer );

		$difficulty = get_post_meta( $post->ID, WPQ_METAKEY_DIFFICULTY, TRUE );
		$question->setDifficulty( $difficulty );

		$percentCorrect = get_post_meta( $post->ID, WPQ_METAKEY_PERCENT_CORRECT, TRUE );
		$question->setPercentCorrect( $percentCorrect );

		$percentIncorrect = get_post_meta( $post->ID, WPQ_METAKEY_PERCENT_INCORRECT, TRUE );
		$question->setPercentIncorrect( $percentIncorrect );

		$smartererId = get_post_meta( $post->ID, WPQ_METAKEY_SMARTERER_ID, TRUE );
		$question->setSmartererId( $smartererId );

		$totalResponses = get_post_meta( $post->ID, WPQ_METAKEY_TOTAL_RESPONSES, TRUE );
		$question->setTotalResponses( $totalResponses );

		return $question;
	}

	/**
	 * Summary.
	 *
	 * @since  1.0.0
	 * @see
	 *
	 * @param $data \WPQuizz\Model\Question
	 *
	 * @return int|\WP_Error
	 * @author nguyenvanduocit
	 */
	public static function save( $data ) {
		if ( static::isExist( $data ) ) {
			wp_send_json( array(
				              'success' => FALSE,
				              'message' => 'this post is exist'
			              ) );
		}
		$postData   = array(
			'post_status'  => 'publish',
			'post_type'    => 'question',
			'ping_status'  => get_option( 'default_ping_status' ),
			'post_parent'  => 0,
			'post_title'   => $data->getQuestion(),
			'post_name'   => md5($data->getQuestion()),
			'post_content' => $data->getQuestion()
		);
		$insertedId = wp_insert_post( $postData );
		if ( $insertedId ) {
			/**
			 * Insert post success, then add metadata
			 */
			update_post_meta( $insertedId, WPQ_METAKEY_CHOICES, maybe_serialize( $data->getChoices() ) );
			update_post_meta( $insertedId, WPQ_METAKEY_ANSWER, $data->getAnswer() );
			update_post_meta( $insertedId, WPQ_METAKEY_DIFFICULTY, $data->getDifficulty() );
			update_post_meta( $insertedId, WPQ_METAKEY_PERCENT_CORRECT, $data->getPercentCorrect() );
			update_post_meta( $insertedId, WPQ_METAKEY_PERCENT_INCORRECT, $data->getPercentIncorrect() );
			update_post_meta( $insertedId, WPQ_METAKEY_SMARTERER_ID, $data->getSmartererId() );
			update_post_meta( $insertedId, WPQ_METAKEY_TOTAL_RESPONSES, $data->getTotalResponses() );
			wp_set_object_terms( $insertedId, $data->getCategory(), 'test', FALSE );

			return $insertedId;
		} else {
			/**
			 * insert not success
			 */
			return new \WP_Error( 'NOT_SUCCESS', 'Insert not success.' );
		}
	}

	/**
	 * Summary.
	 *
	 * @since  1.0.0
	 * @see
	 *
	 * @param $smartererId
	 *
	 * @return \WP_Error|\WPQuizz\Model\Question
	 * @author nguyenvanduocit
	 */
	public static function createFromSmartererId( $smartererId ) {
		$args = array(
			'post_type'  => 'question',
			'meta_query' => array(
				array(
					'key'     => WPQ_METAKEY_SMARTERER_ID,
					'value'   => $smartererId,
					'compare' => '=',
				)
			)
		);
		$posts = get_posts( $args );
		if ( $posts ) {
			$post = new \WP_Post($posts[0]);
			return static::createFromPostId($post);
		}
		return new \WP_Error('NOT_EXIST', 'This id is not match with any question.');
	}

	/**
	 * Summary.
	 *
	 * @since  1.0.0
	 * @see
	 *
	 * @param $question
	 *
	 * @return \WP_Error|\WPQuizz\Model\Question
	 * @author nguyenvanduocit
	 */
	public static function searchByQuestion( $question ) {
		global $wpdb;
		$query = $wpdb->prepare("SELECT post.ID FROM {$wpdb->posts} post WHERE post.post_type = %s AND post.post_name = %s",'question', md5($question));
		$postId = $wpdb->get_var($query);
		if(!$postId){
			return new \WP_Error('NOT_FOUND', 'This question is not exist');
		}
		return static::createFromPostId(abs($postId));
	}
}