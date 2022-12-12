<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordVerification implements Rule
{
    private $passwordVerification;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($passwordVerification)
    {
        $this->passwordVerification = $passwordVerification;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->passwordVerification;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Пароль не верный.';
    }
}
