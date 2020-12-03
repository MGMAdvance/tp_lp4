<?php
spl_autoload_register(function ($class_name) {
    include '../../' . $class_name . '.php';
});

extract($_POST);

if(empty($descricao) || empty($orcamento)){
    header("Location: /");
}

use Models\Projeto;
use Repository\ProjetoRepository;

ProjetoRepository::insert(new Projeto(null, $descricao, $orcamento));

header("Location: /projetos");