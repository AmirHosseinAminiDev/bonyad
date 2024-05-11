<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'last_name' => ['required', 'string', 'min:3', 'max:20'],
            'email' => ['required', 'email', 'min:2', 'max:50'],
            'national_code' => ['required', 'string', 'min:10', 'max:10'],
            'phone' => ['required', 'string', 'min:11', 'max:11'],
            'password' => ['required', 'confirmed', 'min:8', 'max:20']
        ];

        // Ignore current user for unique validation
        $uniqueRule = Rule::unique('users')->ignore($this->user()->id);

        if ($this->method() == 'PUT') {
            if (!$this->has('password') && is_null($this->password)) {
                unset($rules['password']);
            }
            foreach (['email', 'national_code', 'phone'] as $field) {
                $rules[$field][] = $uniqueRule;
            }
        } else {
            foreach (['email', 'national_code', 'phone'] as $field) {
                $rules[$field][] = 'unique:users';
            }
        }

        return $rules;
    }
}
