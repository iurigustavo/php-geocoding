<?php

    namespace App\Http\Livewire\Clients;

    use App\Actions\CEP\SearchCep;
    use App\Actions\Client\CreateClientAddress;
    use App\Actions\Client\DeleteClientAddress;
    use App\Actions\Client\UpdateClientAddress;
    use App\Models\Client;
    use App\Models\ClientAddress;
    use Illuminate\Foundation\Bus\DispatchesJobs;
    use Livewire\Component;

    class Address extends Component
    {
        use DispatchesJobs;

        public Client        $client;
        public ClientAddress $model;

        protected array $rules     = [
            'model.street_address' => ['required'],
            'model.number'         => ['required'],
            'model.complement'     => ['nullable'],
            'model.neighborhood'   => ['required'],
            'model.zipcode'        => ['required'],
            'model.city'           => ['required'],
            'model.state'          => ['required'],
            'model.client_id'      => ['required'],
        ];
        protected       $listeners = [
            'onDeleteConfirmedAction',
            'onDeleteCancelledCallBack'
        ];

        public function create()
        {
            $this->resetInputFields();
        }

        private function resetInputFields()
        {
            $this->model            = new ClientAddress();
            $this->model->client_id = $this->client->id;
        }

        public function mount()
        {
            $this->resetInputFields();
        }

        public function store()
        {
            $this->validate();

            if ($this->model->id > 0) {
                $this->dispatchNow(UpdateClientAddress::fromModel($this->client, $this->model));
                $this->alert('success', 'Registro alterado com sucesso');
            } else {
                $this->dispatchNow(CreateClientAddress::fromModel($this->client, $this->model));
                $this->alert('success', 'Registro cadastrado com sucesso');
            }

            $this->resetInputFields();
        }

        public function destroy($id)
        {
            $this->confirm('Deseja realmente apagar o registro?', [
                'toast'             => FALSE,
                'position'          => 'center',
                'showConfirmButton' => TRUE,
                'cancelButtonText'  => 'Cancelar',
                'confirmButtonText' => 'Apagar',
                'onConfirmed'       => 'onDeleteConfirmedAction',
                'onCancelled'       => 'onDeleteCanceledAction',
            ]);

            $this->model = ClientAddress::find($id);
        }

        public function onDeleteConfirmedAction()
        {
            $this->dispatchNow(new DeleteClientAddress($this->model));
            $this->alert('success', 'Registro excluído com sucesso!!!');
            $this->resetInputFields();
        }

        public function onDeleteCanceledAction()
        {
            $this->resetInputFields();
        }

        public function edit($id)
        {
            $this->model = ClientAddress::find($id);

        }

        public function render()
        {
            $this->client->load('addresses');
            return view('livewire.clients.address');
        }

        public function buscaCep()
        {
            if (strlen($this->model->zipcode) === 8) {
                /** @var \App\Classes\Cep $address */
                $address = $this->dispatchNow(new SearchCep($this->model->zipcode));
                if (!$address) {
                    $this->alert('error', 'CEP não localizado');
                } else {
                    $this->model->street_address = $address->logradouro;
                    $this->model->neighborhood   = $address->bairro;
                    $this->model->city           = $address->localidade;
                    $this->model->state          = $address->uf;
                    $this->model->zipcode        = $address->cep;
                }
            }

            $this->validate();
        }
    }
