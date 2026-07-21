<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => 'required|max:255',
            'email'   => 'required|email',
            'message' => 'required|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => '名前を入力してください。',
            'email.required'   => 'メールアドレスを入力してください。',
            'email.email'      => 'メールアドレスの形式が正しくありません。',
            'message.required' => 'お問い合わせ内容を入力してください。',
        ];
    }
}