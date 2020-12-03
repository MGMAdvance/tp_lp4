<?php
spl_autoload_register(function ($class_name) {
    include '../../' . $class_name . '.php';
});

use Repository\PessoaProjetoRepository;

$pps = PessoaProjetoRepository::getAll();
$pessoas = PessoaProjetoRepository::getPessoaNomes();
$projetos = PessoaProjetoRepository::getProjetosNomes();

require '../../components/header.php'; ?>
<div class="container">
    <form method="POST" action="criar.php">
        <div class="input-group mb-3">

            <select name="pessoa" class="custom-select">
                <option selected>Escolha um colaborador</option>
                <?php foreach ($pessoas as $pessoa) { ?>
                    <option value="<?= $pessoa->getId() ?>"><?= $pessoa->getNome() ?></option>
                <?php } ?>
            </select>

            <select name="projeto" class="custom-select">
                <option selected>Escolha um colaborador</option>
                <?php foreach ($projetos as $projeto) { ?>
                    <option value="<?= $projeto->getId() ?>"><?= $projeto->getDescricao() ?></option>
                <?php } ?>
            </select>
            
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Criar</button>
            </div>
        </div>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Colaborador</th>
                <th scope="col">Projeto</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pps as $pp) { ?>
                <tr>
                    <td><?= $pp['nome'] ?></td>
                    <td><?= $pp['descricao'] ?></td>
                    <td>
                        <div class="row">
                            <form method="POST" action="editar-page.php">
                                <input type="number" name="pessoa" value="<?= $pp['pessoa_id'] ?>" hidden />
                                <input type="number" name="projeto" value="<?= $pp['projeto_id'] ?>" hidden />
                                <button type="submit" class="btn btn-warning">Editar</button>
                            </form>
                            <form method="POST" action="excluir.php">
                                <input type="number" name="pessoa" value="<?= $pp['pessoa_id'] ?>" hidden />
                                <input type="number" name="projeto" value="<?= $pp['projeto_id'] ?>" hidden />
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