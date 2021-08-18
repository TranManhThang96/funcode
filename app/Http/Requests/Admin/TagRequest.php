<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TagRequest extends FormRequest
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
                    'label' => ['required', Rule::unique('tags')->ignore($this->label)],
                ];
            case 'PUT':
                return [
                    'label' => ['nullable', Rule::unique('tags')->ignore($this->id)],
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
                        'label.required' => 'Vui lòng nhập tag.',
                        'label.unique' => 'Tag đã tồn tại.',
                    ];
                case 'PUT':
                    return [
                        'label.unique' => 'Tag đã tồn tại.',
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
