<?php
spl_autoload_register(function ($class_name) {
    include '../../' . $class_name . '.php';
});

extract($_POST);

use Repository\ContratoRepository;

if (empty($id)) {
    header("Location: /");
}

$contrato = ContratoRepository::getById($id);

require '../../components/header.php'; ?>
<div class="container">
    <h2>Editar Contrato</h2>
    <form method="POST" action="editar.php">
        <input type="number" name="id" value="<?= $contrato->getId() ?>" hidden>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="nome">Razão Social</span>
            </div>
            <input type="text" class="form-control" placeholder="Toguro Ltda." value="<?= $contrato->getRazaoSocial() ?>" name="razaoSocial" aria-label="Nome" aria-describedby="nome" required>

            <div class="input-group-prepend">
                <span class="input-group-text" id="telefone">CNPJ</span>
            </div>
            <input type="text" class="form-control" placeholder="74932662000136" value="<?= $contrato->getCnpj() ?>" name="cnpj" aria-label="Telefone" aria-describedby="telefone" required>
            
            <div class="input-group-prepend">
                <span class="input-group-text" id="valor">Valor</span>
            </div>
            <input type="number" class="form-control" placeholder="125000" value="<?= $contrato->getValor() ?>" name="valor" aria-label="Valor" aria-describedby="valor" required>
            
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Editar</button>
            </div>
        </div>
    </form>
</div>
<?php require '../../components/footer.php'; ?>