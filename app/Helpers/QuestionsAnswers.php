<?php

namespace App\Helpers;

use App\Question;

class QuestionsAnswers
{
    private $answers;
    private $questions;
    private $save_answers;

    public function __construct($module, $answers)
    {
        $this->questions = Question::byModule($module)->get()->toArray();
        $this->answers = $answers;
        $this->save_answers = [];
    }

    public function validate_answers()
    {
        $errors = [];
        $answer_format_error = [];

        foreach ($this->answers as $answer_key => $answer) {
            if (!array_key_exists('question_id', $answer) || !array_key_exists('answer', $answer)) {
                $answer_format_error[] = __('La respuesta en la posición :number no tiene el formato correcto.', ['number' => $answer_key]);
            }
        }

        if (!empty($answer_format_error)) {
            return $answer_format_error;
        }

        foreach ($this->questions as $question) {
            foreach ($this->answers as $answer) {
                if (array_key_exists('question_id', $answer) && array_key_exists('answer', $answer)) {
                    if ($question['id'] == $answer['question_id']) {
                        if (strpos($question['possible_response'], $answer['answer']) === false) {
                            $errors[$question['id']] = [
                                __('La respuesta de pregunta con id :number no es correcta.', ['number' => $question['id']])
                            ];
                        } else {
                            $this->save_answers[$question['id']] = $answer;
                        }
                    }
                } else {
                    // TODO: validar sino vienen las llaves question_id, answer en el array answers
                }
            }
        }

        $emptyQuestions = $this->questions;

        foreach ($emptyQuestions as $question_key => $question) {
            foreach ($this->save_answers as $answer) {
                if ($question['id'] == $answer['question_id']) {
                    unset($emptyQuestions[$question_key]);
                }
            }
        }

        if (!empty($emptyQuestions)) {
            foreach ($emptyQuestions as $emptyQuestion) {
                if (array_key_exists($emptyQuestion['id'], $errors)) {
                    array_push($errors[$emptyQuestion['id']], __('La pregunta con id :number no se encuentra diligenciada.', ['number' => $emptyQuestion['id']]));
                } else {
                    $errors[$emptyQuestion['id']] = [
                        __('La pregunta con id :number no se encuentra diligenciada.', ['number' => $emptyQuestion['id']])
                    ];
                }
            }
        }

        return $errors;
    }

    public function get_answers()
    {
        return $this->save_answers;
    }
}
