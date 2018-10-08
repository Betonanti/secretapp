<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Api\Secrets;

class ValidTtl implements Rule
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
            if ($secret->remainingViews == 0)
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
        return 'The TTL expired.';
    }
}
