<?php

namespace App\Http\Requests\BlacklistTag;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlacklistTagRequest extends FormRequest
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
            'name_en' => ['required', 'string', 'unique:blacklist_tags'],
            'name_ch' => ['required', 'string', 'unique:blacklist_tags'],
            'status' => ['required', 'in:0,1']
        ];
    }

    public function messages()
    {
        return [
            'name_en.required' => __('validation.required', ['attribute' => __('cruds.blacklist_tag.fields.title')]),
            'name_en.string' =>  __('validation.string', ['attribute' => __('cruds.blacklist_tag.fields.title')]),
            'name_en.unique' =>  __('validation.unique', ['attribute' => __('cruds.blacklist_tag.fields.title')]),

            'name_ch.required' => __('validation.required', ['attribute' => __('cruds.blacklist_tag.fields.title')]),
            'name_ch.string' =>  __('validation.string', ['attribute' => __('cruds.blacklist_tag.fields.title')]),
            'name_ch.unique' =>  __('validation.unique', ['attribute' => __('cruds.blacklist_tag.fields.title')]),



            'status.required' => __('validation.required', ['attribute' => __('cruds.global.status')]),
            'status.in' => __('validation.required', ['attribute' => __('cruds.global.status')]),
        ];
    }
}
