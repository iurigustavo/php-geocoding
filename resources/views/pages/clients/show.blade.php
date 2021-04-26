<?php
    /**
     * @var \App\Models\Client $model
     */


?>
@extends('adminlte::page')

{{-- Content --}}
@section('content')
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="dados-pessoas-tab" data-toggle="pill" href="#dados-pessoas" role="tab" aria-controls="dados-pessoas" aria-selected="true">Dados Pessoais</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="enderecos-tab" data-toggle="pill" href="#enderecos" role="tab" aria-controls="enderecos" aria-selected="false">Endereços</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="dados-pessoas" role="tabpanel" aria-labelledby="dados-pessoas">
                    @include('pages.clients._form')
                </div>
                <div class="tab-pane fade" id="enderecos" role="tabpanel" aria-labelledby="enderecos">
                    @livewire('clients.address', ['client' => $model])
                </div>
            </div>
        </div>
    </div>
@endsection