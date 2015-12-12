<?php

/**
 * Description of QuestionObject
 *
 * @author Eray
 */
class QuestionObject {
    private $questionId;
    private $description;
    private $mark;
    private $correct;
    private $examId;
    private $optA;
    private $optB;
    private $optC;
    private $optD;
    
        
    function getQuestionId() {
        return $this->questionId;
    }

    function getDescription() {
        return $this->description;
    }

    function getMark() {
        return $this->mark;
    }

    function getCorrect() {
        return $this->correct;
    }

    function getExamId() {
        return $this->examId;
    }

    function getOptA() {
        return $this->optA;
    }

    function getOptB() {
        return $this->optB;
    }

    function getOptC() {
        return $this->optC;
    }

    function getOptD() {
        return $this->optD;
    }

    function setQuestionId($questionId) {
        $this->questionId = $questionId;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setMark($mark) {
        $this->mark = $mark;
    }

    function setCorrect($correct) {
        $this->correct = $correct;
    }

    function setExamId($examId) {
        $this->examId = $examId;
    }

    function setOptA($optA) {
        $this->optA = $optA;
    }

    function setOptB($optB) {
        $this->optB = $optB;
    }

    function setOptC($optC) {
        $this->optC = $optC;
    }

    function setOptD($optD) {
        $this->optD = $optD;
    }


}
