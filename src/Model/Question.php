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


class Question implements \JsonSerializable{
	protected $answer;
	protected $question;
	protected $choices;
	protected $difficulty;
	protected $percent_correct;
	protected $percent_incorrect;
	protected $category;
	protected $smartererId;
	protected $totalResponses;
	/**
	 *
	 */
	public function __construct($smartererId=null, $answer=null,$question=null, $choices=null, $difficulty=null, $percent_correct=null, $percent_incorrect=null, $category=null){

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

	/**
	 * @return mixed
	 */
	public function getSmartererId() {
		return $this->smartererId;
	}

	/**
	 * @param mixed $smartererId
	 */
	public function setSmartererId( $smartererId ) {
		$this->smartererId = $smartererId;
	}

	/**
	 * @return mixed
	 */
	public function getTotalResponses() {
		return $this->totalResponses;
	}

	/**
	 * @param mixed $totalResponses
	 */
	public function setTotalResponses( $totalResponses ) {
		$this->totalResponses = $totalResponses;
	}

	/**
	 * Specify data which should be serialized to JSON
	 *
	 * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 *        which is a value of any type other than a resource.
	 * @since 5.4.0
	 */
	public function jsonSerialize() {
		return array(
			'answer'=>$this->getAnswer(),
			'question'=>$this->getQuestion(),
			'choices'=>$this->getChoices(),
			'difficulty'=>$this->getDifficulty(),
			'percent_correct'=>$this->getPercentCorrect(),
			'percent_incorrect'=>$this->getPercentIncorrect(),
			'category'=>$this->getCategory(),
			'smartererId'=>$this->getSmartererId(),
			'totalResponses'=>$this->getTotalResponses()
		);
}}