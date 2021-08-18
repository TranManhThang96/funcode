<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
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
    public function rules(): array
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
                    'name' => ['nullable', Rule::unique('categories')->ignore($this->id)],
                    'icon' => 'string|nullable',
                    'description' => 'string|nullable'
                ];
            case 'PATCH':
            default:
                break;
        }
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        if (App::getLocale() === 'vi') {
            switch ($this->method()) {
                case 'GET':
                case 'DELETE':
                    return [];
                case 'POST':
                    return [
                        'name.required' => 'Vui lòng nhập tên danh mục.',
                        'name.unique' => 'Tên danh mục đã tồn tại.',
                        'parent_id.numeric' => 'Vui lòng chọn danh mục cha.'
                    ];
                case 'PUT':
                    return [
                        'name.unique' => 'Tên danh mục đã tồn tại.',
                    ];
                case 'PATCH':
                default:
                    break;
            }
        } else {
            return parent::messages();
        }
    }
}
