<?php
spl_autoload_register(function ($class_name) {
    include '../../' . $class_name . '.php';
});

extract($_POST);

use Repository\ProjetoRepository;

if (empty($id)) {
    header("Location: /");
}

$projeto = ProjetoRepository::getById($id);

require '../../components/header.php'; ?>
<div class="container">
    <h2>Editar Projeto</h2>
    <form method="POST" action="editar.php">
        <input type="number" name="id" value="<?= $projeto->getId() ?>" hidden>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="nome">Descrição</span>
            </div>
            <input type="text" class="form-control" placeholder="Um breve resumo" value="<?= $projeto->getDescricao() ?>" name="descricao" aria-label="Nome" aria-describedby="nome" required>

            <div class="input-group-prepend">
                <span class="input-group-text" id="telefone">$</span>
            </div>
            <input type="text" class="form-control" placeholder="11.0000" value="<?= $projeto->getOrcamento() ?>" name="orcamento" aria-label="Telefone" aria-describedby="telefone" required>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Editar</button>
            </div>
        </div>
    </form>
</div>
<?php require '../../components/footer.php'; ?>