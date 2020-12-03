<?php
spl_autoload_register(function ($class_name) {
    include '../../' . $class_name . '.php';
});

extract($_POST);

if(empty($descricao) || empty($orcamento) || empty($id)){
    header("Location: /");
}

use Models\Projeto;
use Repository\ProjetoRepository;

ProjetoRepository::update(new Projeto($id, $descricao, $orcamento));

header("Location: /projetos");