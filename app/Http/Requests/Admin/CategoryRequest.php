<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CategoryRequest extends FormRequest
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
            'name' => Str::lower($this->name)
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
                    'name' => ['required', Rule::unique('categories')->ignore($this->name)],
                    'parent_id' => 'numeric',
                    'icon' => 'string|nullable',
                    'description' => 'string|nullable'
                ];
            case 'PUT':
                return [
                    'name' => ['nullable', 'string', Rule::unique('categories')->ignore($this->id)],
                    'icon' => 'string|nullable',
                    'description' => 'string|nullable'
                ];
            case 'PATCH':
            default:
                break;
        }
    }
}
