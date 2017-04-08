<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        $id = null;
        // check only method (put/patch) for except data
        if (request()->isMethod('put') || request()->isMethod('patch')) {
            $id = ',' . $this->contact->id;
        }

        return [
            'name' => 'required
                        |max:25
                        |unique:contacts,name' . $id,
            'phoneNumber' => 'required
                            |numeric
                            |digits_between:11,14
                            |unique:contacts,phoneNumber' . $id
        ];
    }
}
