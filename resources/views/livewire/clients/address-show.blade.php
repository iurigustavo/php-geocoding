<?php
    /**
     * @var $model \App\Models\ClientAddress
     */
?>

<div wire:ignore.self class="modal fade" id="Address" tabindex="-1" role="dialog" aria-labelledby="Address" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro de Endereço</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label class="col-lg-3 col-xl-2 col-form-label text-right" for="client_id">Cliente</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <select wire:model="model.client_id" class="form-control" id="client_id" name="client_id" required>
                                    <option value="{{$client->id}}" selected="selected">{{$client->name}}</option>
                                </select>
                                @error('model.client_id')
                                <div class="invalid-feedback">*Campo obrigatorio</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-xl-2 col-form-label text-right" for="zipcode">CEP</label>
                        <div class="col-lg-9">
                            <div class="input-group input-group-lg">
                                <input wire:model="model.zipcode" id="zipcode" name="zipcode" type="text" class="form-control @error('model.zipcode') is-invalid @enderror" maxlength="8" required>
                                <span class="input-group-append">
                                    <button type="button" wire:click="buscaCep()" class="btn btn-info btn-flat">Buscar CEP</button>
                              </span>
                            </div>
                            @error('model.zipcode')
                            <div class="invalid-feedback">*Campo obrigatorio</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-xl-2 col-form-label text-right" for="street_address">Logradouro</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <input wire:model="model.street_address" id="street_address" name="street_address" type="text" class="form-control @error('model.street_address') is-invalid @enderror" required>
                                @error('model.street_address')
                                <div class="invalid-feedback">*Campo obrigatorio</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-xl-2 col-form-label text-right" for="number">Número</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <input wire:model="model.number" id="number" name="number" type="text" class="form-control @error('model.number') is-invalid @enderror" required>
                                @error('model.number')
                                <div class="invalid-feedback">*Campo obrigatorio</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-xl-2 col-form-label text-right" for="complement">Complemento</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <input wire:model="model.complement" id="complement" name="complement" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-xl-2 col-form-label text-right" for="neighborhood">Bairro</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <input wire:model="model.neighborhood" id="neighborhood" name="neighborhood" type="text" class="form-control @error('model.neighborhood') is-invalid @enderror" required>
                                @error('model.neighborhood')
                                <div class="invalid-feedback">*Campo obrigatorio</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-xl-2 col-form-label text-right" for="city">Cidade</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <input wire:model="model.city" id="city" name="city" type="text" class="form-control @error('model.city') is-invalid @enderror" required>
                                @error('model.city')
                                <div class="invalid-feedback">*Campo obrigatorio</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-xl-2 col-form-label text-right" for="state">Estado</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <input wire:model="model.state" id="state" name="state" type="text" class="form-control @error('model.state') is-invalid @enderror" required>
                                @error('model.state')
                                <div class="invalid-feedback">*Campo obrigatorio</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="store()" class="btn btn-primary font-weight-bolder text-uppercase mr2" data-dismiss="modal"   >Salvar</button>
                <button type="button" class="btn btn-danger font-weight-bolder text-uppercase close-btn" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>