<?php

    namespace App\Http\Requests\User;

    use App\Models\User;
    use Illuminate\Foundation\Http\FormRequest;

    class UpdateUserRequest extends FormRequest
    {
        public function rules()
        {
            $id = $this->route('usuario')->id;
            return [
                'name'     => 'required',
                'password' => 'required',
                'email'    => 'required|email|unique:users,email,'.$id,
                'enabled'   => 'required',
                'roles'    => 'required',
            ];
        }

        public function authorize()
        {
            return TRUE;
        }

        protected function prepareForValidation()
        {
            $this->merge([
                'password' => $this->password ?? User::find($this->route('usuario')->id)->password
            ]);
        }
    }
