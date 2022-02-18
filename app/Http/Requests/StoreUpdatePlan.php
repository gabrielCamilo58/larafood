<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePlan extends FormRequest
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
        $url = $this->segment(3);
        return [
            'name' => "required|min:3|max:255|unique:plans,name,{$url},url",
            'description' => 'nullable|min:3|max:255',
            'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'O plano digitado ja existe' ,
            'min:3' => 'Digite no minimo 3 carateres',
            'required' => 'Obrigatorio preencher o campo',
            'max:255' => 'O campo deve ter no maximo 255 caracteres',
            'regex' => 'formato digitado invalido'
        ];
    }
}
