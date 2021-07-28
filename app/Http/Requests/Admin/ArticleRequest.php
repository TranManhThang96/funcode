<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleRequest extends FormRequest
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
     * Prepare for Validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'title' => Str::lower($this->title)
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                return [
                    'title' => ['required', 'string', Rule::unique('articles')->ignore($this->title)],
                    'category_id' => 'required|numeric',
                    'excerpt' => 'string|nullable',
                    'content' => 'required',
                    'image' => 'string|nullable'
                ];
            case 'PUT':
                return [
                    'title' => ['required', 'string', Rule::unique('articles')->ignore($this->id)],
                    'category_id' => 'required|numeric',
                    'excerpt' => 'string|nullable',
                    'content' => 'required',
                    'image' => 'string|nullable'
                ];
            case 'PATCH':
            default:
                break;
        }
    }
}
