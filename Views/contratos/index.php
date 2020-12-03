<?php
spl_autoload_register(function ($class_name) {
    include '../../' . $class_name . '.php';
});

use Repository\ContratoRepository;

$contratos = ContratoRepository::getAll();

require '../../components/header.php'; ?>
<div class="container">
    <form method="POST" action="criar.php">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="nome">Razão Social</span>
            </div>
            <input type="text" class="form-control" placeholder="Toguro Ltda." name="razaoSocial" aria-label="Nome" aria-describedby="nome" required>

            <div class="input-group-prepend">
                <span class="input-group-text" id="telefone">CNPJ</span>
            </div>
            <input type="text" class="form-control" placeholder="74932662000136" name="cnpj" aria-label="Telefone" aria-describedby="telefone" required>
            
            <div class="input-group-prepend">
                <span class="input-group-text" id="valor">Valor</span>
            </div>
            <input type="number" class="form-control" placeholder="125000" name="valor" aria-label="Valor" aria-describedby="valor" required>
            
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Criar</button>
            </div>
        </div>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Razão Social</th>
                <th scope="col">CNPJ</th>
                <th scope="col">Valor</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contratos as $contrato) { ?>
                <tr>
                    <th scope="row"><?= $contrato->getId() ?></th>
                    <td><?= $contrato->getRazaoSocial() ?></td>
                    <td><?= $contrato->getCnpj() ?></td>
                    <td>R$<?= $contrato->getValor() ?></td>
                    <td>
                        <div class="row">
                            <form method="POST" action="editar-page.php">
                                <input type="number" name="id" value="<?=$contrato->getId()?>" hidden />
                                <button type="submit" class="btn btn-warning">Editar</button>
                            </form>
                            <form method="POST" action="excluir.php">
                                <input type="number" name="id" value="<?=$contrato->getId()?>" hidden />
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php require '../../components/footer.php'; ?>