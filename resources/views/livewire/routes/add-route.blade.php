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
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Adicionar Endereço
                                </h3>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Selecione o Endereço</label>
                                <div wire:ignore>
                                    <select data-livewire="@this" wire:model.lazy="address_id" name="address_id" id="clientAddressSelect2" style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click.prevent="addAddress()" class="btn btn-primary font-weight-bolder text-uppercase mr2" data-dismiss="modal">Salvar</button>
                        <button type="button" wire:click="closeModal()" class="btn btn-danger font-weight-bolder text-uppercase close-btn" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#Address').modal('show');
        jQuery(document).ready(function () {
            $("#clientAddressSelect2").select2({
                multiple: true,
                ajax: {
                    url: "{{route('api.clientsAddresses')}}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;

                        return {
                            results: data.items,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Pesquisar por endereço',
                minimumInputLength: 5,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            }).on('change', function (e) {
                let livewire = $(this).data('livewire')
                eval(livewire).set('address_id', $(this).val());
            });

            function formatRepo(repo) {
                if (repo.loading) {
                    return repo.text;
                }

                var $container = $(
                    "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__description'></div>" +
                    "<div class='select2-result-repository__statistics'>" +
                    "<div class='select2-result-repository__client'><i class='fa fa-user'></i> </div>" +
                    "<div class='select2-result-repository__location'><i class='fa fa-broadcast-tower'></i> </div>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
                );

                $container.find(".select2-result-repository__description").text(repo.full_address);
                $container.find(".select2-result-repository__client").append(repo.client.name + ' - ' + repo.client.cpf);
                $container.find(".select2-result-repository__location").append(repo.city + " - " + repo.state);

                return $container;
            }

            function formatRepoSelection(repo) {
                return repo.full_address;
            }

        });
    </script>
