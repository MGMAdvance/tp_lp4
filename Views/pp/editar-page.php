<?php
spl_autoload_register(function ($class_name) {
    include '../../' . $class_name . '.php';
});

extract($_POST);

if (empty($pessoa) || empty($projeto)) {
    header("Location: /");
}

use Repository\PessoaProjetoRepository;

$pps = PessoaProjetoRepository::getById($pessoa, $projeto);
$pessoas = PessoaProjetoRepository::getPessoaNomes();
$projetos = PessoaProjetoRepository::getProjetosNomes();

require '../../components/header.php'; ?>
<div class="container">
    <h2>Editar Projeto</h2>
    <form method="POST" action="editar.php">
        <div class="input-group mb-3">
            <select name="pessoa" class="custom-select">
                <option value="<?=$pps->getPessoa()?>" selected><?=$pps->getPessoaNome()?></option>
                <?php foreach ($pessoas as $pessoa) { ?>
                    <option value="<?= $pessoa->getId() ?>"><?= $pessoa->getNome() ?></option>
                <?php } ?>
            </select>

            <select name="projeto" class="custom-select">
                <option value="<?=$pps->getProjeto()?>" selected><?=$pps->getProjetoNome()?></option>
                <?php foreach ($projetos as $projeto) { ?>
                    <option value="<?= $projeto->getId() ?>"><?= $projeto->getDescricao() ?></option>
                <?php } ?>
            </select>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Editar</button>
            </div>
        </div>
    </form>
</div>
<?php require '../../components/footer.php'; ?>