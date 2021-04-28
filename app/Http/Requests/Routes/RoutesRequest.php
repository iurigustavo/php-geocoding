<?php


    namespace App\Http\Requests\RoutesRequest;


    use Illuminate\Foundation\Http\FormRequest;

    /**
     * Class ClientAddressRequest
     *
     * @package App\Http\Requests\ClientAddress
     *
     *
     * @property string $routes
     * @property array  $addresses
     */
    class RoutesRequest extends FormRequest
    {
        public function rules()
        {
            return [
                'route'     => 'required',
                'addresses' => 'required',
            ];
        }
    }