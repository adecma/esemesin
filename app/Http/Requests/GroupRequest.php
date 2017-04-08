<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
            $id = ',' . $this->group->id;
        }

        return [
            'name' => 'required
                        |max:35
                        |unique:groups,name' . $id,
            'description' => 'required'
        ];
    }
}
