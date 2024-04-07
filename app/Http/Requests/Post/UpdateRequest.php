<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:80',
            'content' => 'nullable|string|max:80000',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv|max:25600',
            'is_published' => 'boolean',
            'is_anonymous' => 'string',
        ];
    }
}
