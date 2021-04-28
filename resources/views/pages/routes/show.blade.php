<?php
    /**
     * @var \App\Models\Route $route
     */
?>
@extends('adminlte::page')

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">Rota: {{$route->uuid}}
                </h3>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm table-hover table-sm table-responsive-sm">
                <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Endereço</th>
                    <th>Distância</th>
                </tr>
                </thead>
                <tbody>
                @forelse($route->addresses as $address)
                    <tr>
                        <td>{{$address->clientAddress->client->name}}</td>
                        <td>{{$address->clientAddress->full_address}}</td>
                        <td>{{ number_format($address->distance * 0.001,2,',','.') }} KM</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Sem endereços</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="{!! route('routes.map',$route->uuid) !!}" class="btn btn-success font-weight-bolder text-uppercase">Visualizar Mapa de Entrega</a>
            <a href="{!! route('routes.index') !!}" class="btn btn-danger font-weight-bolder text-uppercase">Voltar</a>
        </div>
    </div>

@endsection
