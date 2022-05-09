<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrCreateQuoteRequest extends FormRequest
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
            'id' => ['sometimes', 'nullable', 'integer', 'exists:tags,id'],
            'text' => ['required', 'string', 'min:10', 'max:4000'],
            'author' => ['required', 'string', 'min:3', 'max:20'],
            'tag_ids' => ['required', 'array', 'min:1', 'max:3'],
            'tag_ids.*' => ['required', 'integer', 'exists:tags,id'],
        ];
    }

    public function messages()
    {
        return [
          'text.required' => 'Добавьте цитату',
          'text.min' => 'Минимум 10 символов',
          'text.max' => 'Максимум 4000 символов',

          'author.required' => 'Добавьте Ваше имя',
          'author.min' => 'Минимум 3 символа',
          'author.max' => 'Максимум 20 символов',

          'tag_ids.required' => 'Добавьте тэги',
          'tag_ids.max' => 'Максимум 3 тэга',
        ];
    }
}
