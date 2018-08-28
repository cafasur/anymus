<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class CheckPermissionDate implements Rule
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
        $value = new Carbon($value);
        $morning = new Carbon($value->toDateString());
        $morning->hour = 7;

        $midday = new Carbon($value->toDateString());
        $midday->hour = 12;
        $midday->minute = 30;

        $afternoon = new Carbon($value->toDateString());
        $afternoon->hour = 14;

        $night = new Carbon($value->toDateString());
        $night->hour = 18;

        return (!$value->isWeekend()) and ($value->between($morning, $midday) or $value->between($afternoon, $night));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La hora y fecha debe estar dentro del horario de lunes a viernes de 7:00am a 12:30pm y 2:00pm a 6:00pm.';
    }
}
