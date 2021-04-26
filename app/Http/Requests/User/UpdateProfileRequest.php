<?php

    namespace App\Http\Requests\User;

    use App\Models\User;
    use Auth;
    use Illuminate\Foundation\Http\FormRequest;

    class UpdateProfileRequest extends FormRequest
    {
        public function rules($id = NULL)
        {
            if ($id == NULL) {
                $id = auth()->id();
            }
            return [
                'name'     => 'required',
                'password' => 'required',
                'email'    => 'required|email|unique:users,email,'.$id,
            ];
        }

        public function authorize()
        {
            return TRUE;
        }

        protected function prepareForValidation()
        {
            $this->merge([
                'password' => $this->password ?? User::find(Auth::id())->password
            ]);
        }
    }
