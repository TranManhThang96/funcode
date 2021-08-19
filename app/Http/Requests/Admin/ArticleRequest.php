<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
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
                    'image' => 'string|nullable',
                    'type' => 'required|numeric',
                    'status' => 'required|numeric'
                ];
            case 'PUT':
                return [
                    'title' => ['required', 'string', Rule::unique('articles')->ignore($this->id)],
                    'category_id' => 'required|numeric',
                    'excerpt' => 'string|nullable',
                    'content' => 'required',
                    'image' => 'string|nullable',
                    'type' => 'required|numeric',
                    'status' => 'required|numeric'
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
                case 'PUT':
                    return [
                        'title.required' => 'Vui lòng tên bài viết.',
                        'title.unique' => 'Tên bài viết đã tồn tại.',
                        'category_id.required' => 'Vui lòng chọn danh mục.',
                        'content.required' => 'Vui lòng nhập nội dung bài viết.',
                        'type.required' => 'Vui lòng chọn loại bài viết.',
                        'status.required' => 'Vui lòng chọn trạng thái bài viết.'
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
