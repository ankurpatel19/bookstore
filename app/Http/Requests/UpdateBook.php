<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBook extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:191',
            'author' => 'required|string|max:50',
            'genre' => 'required|string|max:25',
            'description' => 'required|string',
            'isbn' => 'required|string|max:30',
            'published' => 'required|date',
            'publisher' => 'required|string|max:50',
        ];
    }
}
