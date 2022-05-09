<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchQuotesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => ['sometimes', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'query.required' => 'Введите запрос для поиска',
            'query.string' => 'Запрос для поиска должен состоять из строки',
        ];
    }
}
