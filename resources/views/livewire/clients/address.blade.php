<?php

    use App\Classes\Theme\Metronic;
?>
<div class="card card-custom card-sticky">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">
                Endereços <i class="mr-2"></i>
            </h3>
        </div>
        <div class="card-tools">
            <button wire:click="create()" class="btn btn-lg btn-light font-weight-bolder border-2" data-toggle="modal" data-target="#Address">
                {!! \App\Classes\Theme\Metronic::getSVG("media/svg/icons/Code/Plus.svg", "svg-icon-md svg-icon-primary")!!}
                Cadastrar Novo
            </button>
        </div>
    </div>
    <div class="card-body">
        @include('livewire.clients.address-show')
        <table class="table table-sm table-hover table-sm table-responsive-sm">
            <thead>
            <tr>
                <th>Logradouro</th>
                <th>Número</th>
                <th>Bairro</th>
                <th>CEP</th>
                <th>Cidade/UF</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @forelse($client->addresses as $address)
                <tr>
                    <td>{{$address->street_address}}</td>
                    <td>{{$address->number }}</td>
                    <td>{{$address->neighborhood }}</td>
                    <td>{{$address->zipcode }}</td>
                    <td>{{$address->city }} - {{$address->state}}</td>
                    <td>
                        <button wire:click="edit({{ $address->id }})" title="Edit" class="btn btn-icon btn-light-warning btn-circle" data-toggle="modal" data-target="#Address">{!! Metronic::getSVGDT("media/svg/icons/Communication/Write.svg", "svg-icon svg-icon-md") !!}</button>
                        <button wire:click="destroy({{$address->id}})" title="Delete" class="btn btn-icon btn-light-danger btn-circle">{!! Metronic::getSVGDT("media/svg/icons/General/Trash.svg", "svg-icon svg-icon-md") !!}</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Sem registros</td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
</div>