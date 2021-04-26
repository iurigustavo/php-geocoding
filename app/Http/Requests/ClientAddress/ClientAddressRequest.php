<?php


    namespace App\Http\Requests\ClientAddress;


    use Illuminate\Foundation\Http\FormRequest;

    /**
     * Class ClientAddressRequest
     *
     * @package App\Http\Requests\ClientAddress
     *
     *
     * @property string $street_address
     * @property string $number
     * @property string $complement
     * @property string $neighborhood
     * @property string $zipcode
     * @property string $city
     * @property string $state
     * @property string $client_id
     */
    class ClientAddressRequest extends FormRequest
    {
        public function rules()
        {
            return [
                'street_address' => 'required',
                'number'         => 'required',
                'complement'     => 'nullable',
                'neighborhood'   => 'required',
                'zipcode'        => 'required',
                'city'           => 'required',
                'state'          => 'required',
                'client_id'      => 'required',
            ];
        }
    }