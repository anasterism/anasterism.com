<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactRequest extends Request
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
        return [
            'name'    => 'required',
            'company' => 'required',
            'email'   => 'required|email',
            'phone'   => 'sometimes|regex:/^\(?([0-9]{3})\)?[.\- ]?([0-9]{3})[.\- ]?([0-9]{4})$/',
            'message' => 'required'
        ];
    }
}
