<?php


class ExamObject {
    var $examId,$examName,$examType,$courseId,
        $startDate,$endDate,$duration,$secretCode;
    
    function Exam($examName,$examType,$courseId,$startDate,$endDate,$duration,$secretCode){
        
        $this->examName = $examName;
        $this->examType=$examType;
        $this->courseId=$courseid;
        $this->startDate=$startDate;
        $this->endDate=$endDate;
        $this->duration=$duration;
        $this->secretCode=$secretCode;
}

function getExamId() {
    return $this->examId;
}

function getExamName() {
    return $this->examName;
}

function getExamType() {
    return $this->examType;
}

function getCourseId() {
    return $this->courseId;
}

function getStartDate() {
    return $this->startDate;
}

function getEndDate() {
    return $this->endDate;
}

function getDuration() {
    return $this->duration;
}

function getSecretCode() {
    return $this->secretCode;
}

function setExamId($examId) {
    $this->examId = $examId;
}

function setExamName($examName) {
    $this->examName = $examName;
}

function setExamType($examType) {
    $this->examType = $examType;
}

function setCourseId($courseId) {
    $this->courseId = $courseId;
}

function setStartDate($startDate) {
    $this->startDate = $startDate;
}

function setEndDate($endDate) {
    $this->endDate = $endDate;
}

function setDuration($duration) {
    $this->duration = $duration;
}

function setSecretCode($secretCode) {
    $this->secretCode = $secretCode;
}


}
