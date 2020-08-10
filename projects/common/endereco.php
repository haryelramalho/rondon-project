<div class="card form-group">
    <h2 class="card-header">
        <i class="fas fa-address-card"></i>
        Endereço
    </h2>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p class="text-muted">
                    Informe o CEP da localidade e os demais campos
                    aparecerão. No caso de ser informado
                    CEP por munícipio, o bairro e logradouro devem
                    ser informados manualmente. Não sabe o CEP?
                    <a target="_blank" href="http://www.buscacep.correios.com.br/sistemas/buscacep/buscaCep.cfm">
                        Pesquisar
                    </a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="cep">CEP</label>
                <input type="tel" class="form-control" id="cep" name="cep"
                       placeholder="00000-000" required
                       pattern="[0-9]{5}[-][0-9]{3}">
                <div class="invalid-feedback" id="cep-feedback">
                    Informe um CEP válido!
                </div>
            </div>
        </div>
        <div class="collapse" id="endereco">
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="estado">U.F.</label>
                    <input readonly type="text" class="form-control" name="uf" id="uf">
                </div>
                <div class="form-group col-md-4">
                    <label for="cidade">Cidade</label>
                    <input readonly type="text" class="form-control" id="cidade" name="cidade">
                </div>
                <div class="form-group col-md">
                    <label for="bairro">Bairro</label>
                    <input type="text" class="form-control" id="bairro"
                           name="bairro" pattern=".{3,255}" required>
                    <div class="invalid-feedback">
                        Um bairro deve ser informado!
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="logradouro">Logradouro</label>
                    <input type="text" class="form-control" id="logradouro"
                           name="logradouro" pattern=".{3,255}" required>
                    <div class="invalid-feedback">
                        Um logradouro deve ser informado!
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label for="numero">Número</label>
                    <input type="number" class="form-control" id="numero"
                           name="numero" required min="1" max="9999">
                    <div class="invalid-feedback">
                        Informe o número da casa!
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <label for="complemento">
                        Complemento
                        <small class="text-muted"> <i>(opcional)</i></small>
                    </label>
                    <input type="text" class="form-control" id="complemento"
                           name="complemento" pattern=".{3,255}">
                    <div class="invalid-feedback">
                        Informe um complemento. Ou deixe em branco
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<button type="button" class="collapse"
        id="exibir-endereco"
        data-toggle="collapse"
        data-target="#endereco"
        aria-expanded="false"
        aria-controls="exibir endereço">
    endereco
</button>
