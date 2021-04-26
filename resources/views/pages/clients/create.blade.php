<?php
    /**
     * @var \App\Models\Client $model
     */


?>
@extends('adminlte::page')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">Registro
                </h3>
            </div>
        </div>
        @include('pages.clients._form')
    </div>

@endsection