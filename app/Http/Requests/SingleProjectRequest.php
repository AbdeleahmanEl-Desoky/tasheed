<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SingleProjectRequest extends FormRequest
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
            'description' =>'required',
        ];

        // Check if the request is a POST request (for storing a new gallery item)
        if ($this->isMethod('post')) {
            $rules['file'] = 'required ';
        }

        // Check if the request is PUT or PATCH (for updating an existing gallery item)
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['file'] = 'nullable ';
        }

        return $rules;
    }
}
