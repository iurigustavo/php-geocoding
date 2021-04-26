<?php
    /**
     * @var \App\Models\Client $model
     */

?>
@if($model->id > 0)
    {!! Form::open(['url' => route('clients.update',$model->id), 'id'=>'validate', 'method' => 'put']) !!}
@else
    {!! Form::open(['url' => route('clients.store'), 'id' => 'validate']) !!}
@endif
<div class="card-body">
    <div class="form-group row">
        {!! Form::label('name','Nome',['class' => 'col-lg-3 col-xl-2 col-form-label text-right']) !!}
        <div class="col-lg-9">
            <div class="input-group">
                {!! Form::text('name',$model->name, [ 'id' => 'name','class' => 'form-control validate[required]']) !!}
            </div>
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('email','E-Mail',['class' => 'col-lg-3 col-xl-2 col-form-label text-right']) !!}
        <div class="col-lg-9">
            <div class="input-group">
                {!! Form::text('email',$model->email, [ 'id' => 'email','class' => 'form-control validate[required,custom[email]]']) !!}
            </div>
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('cpf','CPF',['class' => 'col-lg-3 col-xl-2 col-form-label text-right']) !!}
        <div class="col-lg-9">
            <div class="input-group">
                {!! Form::text('cpf',$model->cpf, [ 'id' => 'cpf','class' => 'form-control validate[required] maskCpf']) !!}
            </div>
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('birth_date','Data de Nascimento',['class' => 'col-lg-3 col-xl-2 col-form-label text-right']) !!}
        <div class="col-lg-9">
            <div class="input-group">
                {!! Form::text('birth_date', \App\Http\Helpers\DateUtils::DataParaString($model->birth_date), [ 'id' => 'birth_date','class' => 'form-control validate[required] maskData']) !!}
            </div>
        </div>
    </div>

</div>

<div class="card-footer">
    {!! Form::submit('Salvar',['class' => 'btn btn-primary font-weight-bolder text-uppercase mr2']) !!}
    <a href="{!! route('clients.index') !!}" class="btn btn-danger font-weight-bolder text-uppercase">Voltar</a>
</div>
{!! Form::close() !!}