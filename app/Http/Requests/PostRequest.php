<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required','min:3'],
            'description' => ['required','min:5'],
            // 'post_creator' => ['required','exists:users,id']
        ];
    }

    //to show messages on validation
    public function messages(): array
    {
        return [
            'title.required' => __('messages.The title field is required'),
            'description.required' => __('messages.We need the description'),
            'title.min' => __('messages.The title must be at least 3 characters'),
        ];
    }
}
