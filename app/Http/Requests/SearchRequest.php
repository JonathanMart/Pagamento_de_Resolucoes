<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'tipo_consulta' => 'required',
            'ano_empenho' => 'required', 
            'conta' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tipo_consulta.required' => 'É obrigatório informar o tipo de consulta',
            'ano_empenho.required' => 'É obrigatório informar o Ano do Empenho',
            'conta.required' => 'É obrigatório informar a Conta  Corrente',
        ];
    }
}
