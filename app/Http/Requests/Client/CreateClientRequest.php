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
    class CreateClientRequest extends FormRequest
    {
        public function rules()
        {
            return [
                'name'       => 'required',
                'email'      => 'required|email|unique:clients,email',
                'cpf'        => 'required|unique:clients,cpf',
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
