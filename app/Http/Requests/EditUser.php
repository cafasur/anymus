<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class EditUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Collection::make([
            'last_name' => 'required|string|max:191',
            'unit' => 'required|numeric|exists:units,id',
            'status' => 'required|numeric|exists:user_status,id',
            ]);

        $rules->put('first_name', 'required|string|max:191');

        if($this->input('email') !== $this->user()->email){
            $rules->put('email', 'required|email|unique:users,email|max:191');
        }else{
            $rules->put('email', 'required|email|max:191');
        }

        if(!empty($this->input('password'))){
            $rules->put('password', 'required|confirmed|max:191');
        }
        return $rules->toArray();
    }
}
