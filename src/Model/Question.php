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

namespace WPQuizz\Model;


class Question {
	protected $answer;
	protected $question;
	protected $choices;
	protected $difficulty;
	protected $percent_correct;
	protected $percent_incorrect;
	protected $category;
	/**
	 *
	 */
	public function __construct($answer=null,$question=null, $choices=null, $difficulty=null, $percent_correct=null, $percent_incorrect=null, $category=null){

	}
	/**
	 * @return mixed
	 */
	public function getQuestion() {
		return $this->question;
	}

	/**
	 * @param mixed $question
	 */
	public function setQuestion( $question ) {
		$this->question = $question;
	}

	/**
	 * @return mixed
	 */
	public function getChoices() {
		return (array)$this->choices;
	}

	/**
	 * @param mixed $choices
	 */
	public function setChoices( $choices ) {
		$choices = (array)$choices;
		$this->choices = $choices;
	}

	/**
	 * @return mixed
	 */
	public function getDifficulty() {
		return $this->difficulty;
	}

	/**
	 * @param mixed $difficulty
	 */
	public function setDifficulty( $difficulty ) {
		$this->difficulty = $difficulty;
	}

	/**
	 * @return mixed
	 */
	public function getPercentCorrect() {
		return $this->percent_correct;
	}

	/**
	 * @param mixed $percent_correct
	 */
	public function setPercentCorrect( $percent_correct ) {
		$this->percent_correct = $percent_correct;
	}

	/**
	 * @return mixed
	 */
	public function getPercentIncorrect() {
		return $this->percent_incorrect;
	}

	/**
	 * @param mixed $percent_incorrect
	 */
	public function setPercentIncorrect( $percent_incorrect ) {
		$this->percent_incorrect = $percent_incorrect;
	}

	/**
	 * @return mixed
	 */
	public function getAnswer() {
		return $this->answer;
	}

	/**
	 * @param mixed $answer
	 */
	public function setAnswer( $answer ) {
		$this->answer = $answer;
	}

	/**
	 * @return string[]
	 */
	public function getCategory() {
		return (array)$this->category;
	}

	/**
	 * @param mixed $category
	 */
	public function setCategory( $category ) {
		$this->category = (array)$category;
	}
}