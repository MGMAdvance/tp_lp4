<?php
spl_autoload_register(function ($class_name) {
    include '../../' . $class_name . '.php';
});

use Repository\ProjetoRepository;

$projetos = ProjetoRepository::getAll();

require '../../components/header.php'; ?>
<div class="container">
    <form method="POST" action="criar.php">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="nome">Descrição</span>
            </div>
            <input type="text" class="form-control" placeholder="Um breve resumo" name="descricao" aria-label="Nome" aria-describedby="nome" required>

            <div class="input-group-prepend">
                <span class="input-group-text" id="telefone">$</span>
            </div>
            <input type="text" class="form-control" placeholder="11.0000" name="orcamento" aria-label="Telefone" aria-describedby="telefone" required>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Criar</button>
            </div>
        </div>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Descrição</th>
                <th scope="col">Orçamento</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projetos as $projeto) { ?>
                <tr>
                    <th scope="row"><?= $projeto->getId() ?></th>
                    <td><?= $projeto->getDescricao() ?></td>
                    <td>R$<?= $projeto->getOrcamento() ?></td>
                    <td>
                        <div class="row">
                            <form method="POST" action="editar-page.php">
                                <input type="number" name="id" value="<?=$projeto->getId()?>" hidden />
                                <button type="submit" class="btn btn-warning">Editar</button>
                            </form>
                            <form method="POST" action="excluir.php">
                                <input type="number" name="id" value="<?=$projeto->getId()?>" hidden />
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