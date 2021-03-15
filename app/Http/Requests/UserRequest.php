<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email'    => 'required|email',
            'password' => 'required',
        ];
    }

    public function withValidator($validator)
    {
        $user = User::where('email', $this->get('email'))->first();
        $validator->after(function ($validator) use ($user) {
            if (!$user || !Hash::check($this->get('password'), $user->password)) {
                $validator->errors()->add('email', 'The Email or Password were not valid');
                return;
            }
        });
    }
}
