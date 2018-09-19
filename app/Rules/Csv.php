<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Csv implements Rule
{
    const VALID_MIMETYPES = ['text/csv', 'application/csv'];

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!in_array($value->getClientMimeType(), static::VALID_MIMETYPES)) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The provided file is not a valid .CSV';
    }
}
