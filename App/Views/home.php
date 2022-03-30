        
            <main>
                <div class="py-4 text-center">
                    <img class="d-block mx-auto mb-4" src="/assets/images/logo.png" alt="" width="60">
                    <h2>Buscar pelo Cep</h2>
                    <p class="lead">Realize a busca do seu endereço através do CEP.</p>
                </div>
                <div class="row px-5 mx-md-5">
                    <div class="col-md-12 p-0 my-2">
                        <div class="col-md-12" id="alert"></div>
                        <form class="needs-validation row g-3" novalidate>
                            <div class=" col-auto col-md-4">
                                <label for="cep" class="visually-hidden">Cep</label>
                                <input type="text" class="form-control" id="cep" required placeholder="Informe o cep" maxlength="9">
                                <div class="invalid-feedback">Campo obrigatório.</div>
                            </div>
                            <div class="col-auto col-md-2">
                                <button type="submit" class="btn btn-primary mb-3" id="btn-search">Buscar</button>
                            </div>
                        </form>
                    </div>
                    <div class="list-group p-0">
                        <div class="list-group-item list-group-item-action d-flex gap-3 py-3">
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <h6 class="mb-0">Rua</h6>
                                <p class="mb-0 opacity-75 logradouro"></p>
                            </div>
                        </div>
                        <div class="list-group-item list-group-item-action d-flex gap-3 py-3">
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <h6 class="mb-0">Bairro</h6>
                                <p class="mb-0 opacity-75 bairro"></p>
                            </div>
                        </div>
                        <div class="list-group-item list-group-item-action d-flex gap-3 py-3">
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <h6 class="mb-0">Cidade</h6>
                                <p class="mb-0 opacity-75 localidade"></p>
                            </div>
                        </div>
                        <div class="list-group-item list-group-item-action d-flex gap-3 py-3">
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <h6 class="mb-0">Estado</h6>
                                <p class="mb-0 opacity-75 uf"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>