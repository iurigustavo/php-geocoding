<?php
    /**
     * @var \App\Models\Client $model
     */


?>
@extends('adminlte::page')

{{-- Content --}}
@section('content')

    @livewire('routes.create-route', ['route' => $model, 'listClientsAddresses' => $listClientsAddresses])

@endsection
