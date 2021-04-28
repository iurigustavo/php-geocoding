<?php

    namespace App\Http\Livewire\Routes;

    use App\Models\ClientAddress;
    use App\Models\Route;
    use App\Models\RouteAddress;
    use Arr;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Foundation\Bus\DispatchesJobs;
    use Livewire\Component;

    class CreateRoute extends Component
    {
        use DispatchesJobs;

        public Route      $route;
        public Collection $listClientsAddresses;
        public ?array     $address_id = NULL;
        public bool       $isOpen     = FALSE;
        /**
         * @var \App\Models\ClientAddress[]
         */
        public array $deliveryRoutes;

        public function mount()
        {
        }

        public function render()
        {

            return view('livewire.routes.create-route');
        }

        public function store($route)
        {
            if (sizeof($route) > 0) {
                $listAddresses = $route['addresses'];
                $listAddresses = Arr::pluck($listAddresses, 'client_address.id');
                $route         = $this->dispatchNow(\App\Actions\Routes\CreateRoute::fromArray($listAddresses));
                return redirect()->to(\route('routes.show', $route->id));
            }
            $this->alert('error', 'Erro ao salvar');
        }

        public function addAddress()
        {
            if ($this->address_id == NULL) {
                return;
            }
            foreach ($this->address_id as $address_id) {
                $clientAddress = ClientAddress::query()->with('client')->whereId($address_id)->first();
                $routeAddress  = new RouteAddress();
                $routeAddress->setRelation('clientAddress', $clientAddress);
                $this->route->addresses->add($routeAddress);
            }
            $this->closeModal();
        }

        public function closeModal()
        {
            $this->isOpen = FALSE;
            $this->resetInputFields();
        }

        private function resetInputFields()
        {
            $this->address_id = NULL;
        }

        public function create()
        {
            $this->openModal();
        }

        public function openModal()
        {
            $this->resetInputFields();
            $this->isOpen = TRUE;
        }

    }
