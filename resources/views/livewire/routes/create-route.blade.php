<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">Rota
            </h3>
        </div>
        <div class="card-tools">
            <button wire:click="create()" class="btn btn-lg btn-primary font-weight-bolder border-2">
                {!! \App\Classes\Theme\Metronic::getSVG("media/svg/icons/Code/Plus.svg", "svg-icon-md svg-icon-primary")!!}
                Adicionar Endereço
            </button>
        </div>
    </div>
    @if($isOpen)
        @include('livewire.routes.add-route')
    @endif
    <div class="card-body">
        <table class="table table-sm table-hover table-sm table-responsive-sm">
            <thead>
            <tr>
                <th>Cliente</th>
                <th>Endereço</th>
            </tr>
            </thead>
            <tbody>
            @forelse($route->addresses as $address)
                <tr>
                    <td>{{$address->clientAddress->client->name}}</td>
                    <td>{{$address->clientAddress->full_address}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Sem endereços</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        @if(sizeof($route->addresses) > 0)
            <button wire:click="store({{$route}})" class="btn btn-lg btn-primary font-weight-bolder border-2">
                {!! \App\Classes\Theme\Metronic::getSVG("media/svg/icons/Code/Plus.svg", "svg-icon-md svg-icon-primary")!!}
                Salvar
            </button>
        @endif

    </div>
</div>
