<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Api\Secrets;
use Illuminate\Support\Carbon;

class ValidExpirationTime implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $secret = Secrets::where($attribute,$value)->first();

        try {
            if (Carbon::parse($secret->expiresAt) < Carbon::today())
                return false;
            else
                return true;
        }catch(\Exception $e){
            //not isset
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The expiration time is expired';
    }
}
