<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'     => ['required', 'string', 'unique:projects,title'],
            'type'      => ['required', 'string'],  
            'tags'      => ['required'],
            // 'tags_id'   => ['required'],
            'budget'    => ['required', 'numeric'],
            'comment'   => ['required', 'string'],
            'status'    => ['required', 'in:0,1'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => __('validation.required', ['attribute' => __('cruds.create_project.fields.title')]),
            'title.string' =>  __('validation.string', ['attribute' => __('cruds.create_project.fields.title')]),
            'title.unique' =>  __('validation.unique', ['attribute' => __('cruds.create_project.fields.title')]),

            'type.required' => __('validation.required', ['attribute' => __('cruds.create_project.fields.type')]),
            'type.string' =>  __('validation.string', ['attribute' => __('cruds.create_project.fields.type')]),

            'tags_id.required' => __('validation.required', ['attribute' => __('cruds.create_project.fields.tags')]),
            'tags_id.string' =>  __('validation.string', ['attribute' => __('cruds.create_project.fields.tags')]),

            'budget.numeric' => __('validation.numeric', ['attribute' => __('cruds.create_project.fields.budget')]),

            'comment.required' => __('validation.required', ['attribute' => __('cruds.create_project.fields.description')]),
            'comment.string' => __('validation.string', ['attribute' => __('cruds.create_project.fields.description')]),

            'status.required' => __('validation.required', ['attribute' => __('cruds.global.status')]),
            'status.in' => __('validation.in', ['attribute' => __('cruds.global.status')]),
        ];
    }
}
