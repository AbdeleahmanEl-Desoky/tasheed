<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeRequest extends FormRequest
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
        $rules = [
            'title' => 'required',
            'date'=> 'required',
            'description' =>'required',
            'file_type' => 'required|string',
        ];

        if ($this->input('file_type') === 'image') {
            $rules['file'] = 'nullable|image|mimes:jpg,jpeg,png '; // max 1 MB
        } elseif ($this->input('file_type') === 'video') {
            $rules['file'] = 'nullable|mimes:mp4|max:52428800'; // max 50 MB
        }

        return $rules;

    }
}
