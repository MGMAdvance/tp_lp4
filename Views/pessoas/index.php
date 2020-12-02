<?php
spl_autoload_register(function ($class_name) {
    include '../../' . $class_name . '.php';
});

use Repository\PessoaRepository;

$pessoas = PessoaRepository::getAll();

require '../../components/header.php'; ?>
<div class="container">
    <form method="POST" action="criar.php">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="nome">Nome</span>
            </div>
            <input type="text" class="form-control" placeholder="Matheus" name="nome" aria-label="Nome" aria-describedby="nome" required>

            <div class="input-group-prepend">
                <span class="input-group-text" id="telefone">Telefone</span>
            </div>
            <input type="text" class="form-control" placeholder="119981999" name="telefone" aria-label="Telefone" aria-describedby="telefone" required>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Criar</button>
            </div>
        </div>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Telefone</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pessoas as $pessoa) { ?>
                <tr>
                    <th scope="row"><?= $pessoa->getId() ?></th>
                    <td><?= $pessoa->getNome() ?></td>
                    <td><?= $pessoa->getTelefone() ?></td>
                    <td>
                        <div class="row">
                            <form method="POST" action="editar-page.php">
                                <input type="number" name="id" value="<?=$pessoa->getId()?>" hidden />
                                <button type="submit" class="btn btn-warning">Editar</button>
                            </form>
                            <form method="POST" action="excluir.php">
                                <input type="number" name="id" value="<?=$pessoa->getId()?>" hidden />
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