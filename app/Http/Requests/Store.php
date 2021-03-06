<?php

namespace Uxcamp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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

                'name' =>'required|max:50',
                'bio' =>'required',
                'slug'=>'required',
                'avatar'=>'required|image|mimes:jpeg,bmp,png',
                'user_id'=>'required'

           ];
    }
}
