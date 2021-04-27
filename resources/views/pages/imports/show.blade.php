@extends('adminlte::page')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">Importação: {{$model->path}}
                </h3>
            </div>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4">Arquivo:</dt>
                <dd class="col-sm-8"><a href="{{route('imports.downloadFile',$model->id)}}" target="_blank">{{$model->path}}</a></dd>
                <dt class="col-sm-4">Total de linhas importadas:</dt>
                <dd class="col-sm-8">{{$model->total_rows}}</dd>
                <dt class="col-sm-4">Processado:</dt>
                <dd class="col-sm-8">{{$model->processed ? 'Sim' : 'Não'}}</dd>
                <dt class="col-sm-4">Criado em:</dt>
                <dd class="col-sm-8">{{\App\Http\Helpers\DateUtils::DataHoraParaString($model->created_at)}}</dd>
                <dt class="col-sm-4">Executado em:</dt>
                <dd class="col-sm-8">{{\App\Http\Helpers\DateUtils::DataHoraParaString($model->updated_at)}}</dd>
            </dl>
        </div>

        <div class="card-footer">
            <a href="{!! route('imports.index') !!}" class="btn btn-danger font-weight-bolder text-uppercase">Voltar</a>
        </div>
    </div>

@endsection