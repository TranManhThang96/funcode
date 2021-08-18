<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SeriesRequest extends FormRequest
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
                    'name' => ['required', Rule::unique('series')->ignore($this->name)],
                ];
            case 'PUT':
                return [
                    'name' => ['nullable', Rule::unique('series')->ignore($this->id)],
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
                        'name.required' => 'Vui lòng nhập tên series.',
                        'name.unique' => 'Tên series đã tồn tại.',
                    ];
                case 'PUT':
                    return [
                        'name.unique' => 'Tên series đã tồn tại.',
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
