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
        return [
            'title' => 'required',
            'date'=> 'required',
            'description' =>'required',
        ];

        if ($this->isMethod('post')) {
            $rules['file_type'] = 'required|string';
            $rules['file'] = [
                'required',
                'file',
                function ($attribute, $value, $fail) {
                    $fileType = request()->input('file_type');

                    if ($fileType === 'image' && !$value->isValid() && !in_array($value->getClientMimeType(), ['image/webp','image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'])) {
                        $fail('The ' . $attribute . ' must be a valid image file (jpeg, png, jpg, gif, svg, webp).');
                    }

                    if ($fileType === 'video' && !$value->isValid() && $value->getClientMimeType() !== 'video/mp4') {
                        $fail('The ' . $attribute . ' must be a valid video file (mp4).');
                    }
                },
                'max:2048', // max size in KB
            ];

        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['file_type'] = 'required|string';
            $rules['file'] = [
                'nullable',
                'file',
                function ($attribute, $value, $fail) {
                    $fileType = request()->input('file_type');

                    if ($fileType === 'image' && !$value->isValid() && !in_array($value->getClientMimeType(), ['image/webp','image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'])) {
                        $fail('The ' . $attribute . ' must be a valid image file (jpeg, png, jpg, gif, svg, webp).');
                    }

                    if ($fileType === 'video' && !$value->isValid() && $value->getClientMimeType() !== 'video/mp4') {
                        $fail('The ' . $attribute . ' must be a valid video file (mp4).');
                    }
                },
                'max:2048', // max size in KB
            ];
        }

    }
}
