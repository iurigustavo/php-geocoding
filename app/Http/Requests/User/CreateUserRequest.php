<?php

    namespace App\Http\Requests\User;

    use Illuminate\Foundation\Http\FormRequest;

    /**
     * @property string $name
     * @property string $password
     * @property string $email
     * @property string $enabled
     * @property array  $roles
     */
    class CreateUserRequest extends FormRequest
    {
        public function rules()
        {
            return [
                'name'     => 'required',
                'password' => 'required',
                'email'    => 'required|email|unique:users,email',
                'enabled'  => 'required',
                'roles'    => 'required',
            ];
        }

        public function authorize()
        {
            return TRUE;
        }


    }
