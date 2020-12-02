<?php
spl_autoload_register(function ($class_name) {
    include '../../' . $class_name . '.php';
});

extract($_POST);

use Repository\PessoaRepository;

if (empty($id)) {
    header("Location: /");
}

$pessoa = PessoaRepository::getById($id);

require '../../components/header.php'; ?>
<div class="container">
    <h2>Editar Pessoa</h2>
    <form method="POST" action="editar.php">
        <input type="number" name="id" value="<?= $pessoa->getId() ?>" hidden>
        <div class="input-group mb-3">

            <div class="input-group-prepend">
                <span class="input-group-text" id="nome">Nome</span>
            </div>
            <input type="text" class="form-control" placeholder="Matheus" name="nome" value="<?= $pessoa->getNome() ?>" aria-label="Nome" aria-describedby="nome" required>

            <div class="input-group-prepend">
                <span class="input-group-text" id="telefone">Telefone</span>
            </div>
            <input type="text" class="form-control" placeholder="119981999" name="telefone" value="<?= $pessoa->getTelefone() ?>" aria-label="Telefone" aria-describedby="telefone" required>
            
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Editar</button>
            </div>

        </div>
    </form>
</div>
<?php require '../../components/footer.php'; ?>