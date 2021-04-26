<?php

    namespace App\Http\Requests\Client;

    use App\Http\Helpers\DateUtils;
    use Illuminate\Foundation\Http\FormRequest;

    /**
     * @property string $name
     * @property string $email
     * @property string $cpf
     * @property string  $birth_date
     */
    class UpdateClientRequest extends FormRequest
    {
        public function rules()
        {
            $id = $this->route('client')->id;
            return [
                'name'       => 'required',
                'email'      => 'required|email|unique:clients,email,'.$id,
                'cpf'        => 'required|unique:clients,cpf,'.$id,
                'birth_date' => 'required|date',
            ];
        }

        protected function prepareForValidation()
        {
            $this->merge([
                'birth_date' => DateUtils::StringParaData($this->birth_date),
            ]);
        }

    }
