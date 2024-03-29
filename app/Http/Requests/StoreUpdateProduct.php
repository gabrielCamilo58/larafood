<?php

namespace App\Http\Requests;

use App\Tenant\Rules\UniqueTenant;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProduct extends FormRequest
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
        $id = $this->segment(3);
        $rules = [
            'name' => ['required',
            'min:3',
            'max:255',
            //unique:products,name,{$id},id'
            new UniqueTenant('products', $id)
        ],
            'description' => "required|min:3|max:10000",
            'image' => "required|image",
        ];

        if ($this->method() == 'PUT')
        $rules = [
            'name' => "required|min:3|max:255|unique:products,name,{$id},id",
            'description' => "required|min:3|max:10000",
            'image' => "nullable|image",
        ];

    return $rules;
    }
}
