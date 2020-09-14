<?php


namespace Atom\Validation\Exceptions;

use Exception;

class ValidationException extends Exception
{
    /**
     * @var $errors
     */
    private $errors;

    public function __construct($errors)
    {
        parent::__construct();
        $this->errors = $errors;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }


}
