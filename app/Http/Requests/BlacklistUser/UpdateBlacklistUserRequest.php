<?php

namespace App\Http\Requests\BlacklistUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBlacklistUserRequest extends FormRequest
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
        $id = $this->id;
        return [
            'email' => ['required', 'email', Rule::unique('blacklist_users')->ignore($id)],
            'ip_address' => 'required|ip',
            // 'blacklist_tag_id' => 'required',
            // 'other_reason' => ['required_if:blacklist_tag_id,other', 'nullable', 'string', 'max:255']
            'blacklist_tag_id' => 'nullable',
            'other_reason' => ['nullable', 'string', 'max:255']
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('validation.required', ['attribute' => __('pages.blacklist_user.form.fields.email')]),
            'email.email' =>  __('validation.email', ['attribute' => __('pages.blacklist_user.form.fields.email')]),
            'ip_address.required' => __('validation.required', ['attribute' => __('pages.blacklist_user.form.fields.ip_address')]),
            'ip_address.ip' =>  __('validation.ip', ['attribute' => __('pages.blacklist_user.form.fields.ip_address')]),
            'blacklist_tag_id.required' => __('validation.required', ['attribute' => __('pages.blacklist_user.form.fields.reason')]),

            'other_reason.required_if' => trans('messages.other_reason.required_if'),
        ];
    }
}
