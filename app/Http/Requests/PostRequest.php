<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:4',
                Rule::unique('posts', 'title')->ignore($this->route('post')?->id)
//                'unique:posts,title' // ensure column title value in posts table is unique
            ],
            'slug' => [
                'required',
                // ensure column slug value in posts table is unique except for the current post in case of update
                Rule::unique('posts', 'slug')->ignore($this->route('post')?->id)
            ],
            'content' => 'required|string'
        ];
    }
}
