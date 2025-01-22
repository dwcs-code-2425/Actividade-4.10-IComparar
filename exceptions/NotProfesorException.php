<?php
namespace exceptions;
class NotProfesorException extends \Exception{
    private $otherObject;

    public function __construct($otherObject) {
        $this->otherObject = $otherObject;
        parent::__construct("O obxecto non é de tipo Profesor. É de tipo: " . get_class($otherObject));
    }
}