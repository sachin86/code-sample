<?php

namespace App\Validators;

class Validator
{
    /**
     * All errors generated by a failed validation.
     * Retrieved by getErrors()
     *
     * @var array
     */
    protected $errors = [];

    /**
     * List of user inputs
     * Set by with()
     *
     * @var array
     */
    protected $input = [];

    /**
     * Custom error messages for the validator
     *
     * @var array
     */
    protected $messages = [];

    /**
     * Rules to apply to the input
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Variable that hold the ref. of the validator.
     *
     * @return array
     */
    protected $validator;

    /**
     * Get the validator's errors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Get the validator instance for front view.
     *
     * @return array
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * Get the validator's getMessageBag
     *
     * @return array
     */
    public function getMessageBag()
    {
        return $this->validator->getMessageBag();
    }

    /**
     * Run the validator over the input
     *
     * @return bool
     */
    public function passes()
    {
        $this->validator = app('validator')->make($this->input, $this->rules);
        
        if ($this->validator->fails()) {
            $this->errors = $this->validator->errors()->toArray();
            return FALSE;
        }

        return TRUE;
    }

    /**
     * Set the validator's inputs
     *
     * @param  array $input
     * @return this
     */
    public function with(array $input)
    {
        $this->input = $input;
        return $this;
    }

    /**
     * Set the validator's rules
     *
     * @param  array $rules
     * @return this
     */
    public function setRules(array $rules)
    {
        $this->rules = $rules;
        return $this;
    }
}