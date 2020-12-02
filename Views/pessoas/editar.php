<?php
spl_autoload_register(function ($class_name) {
    include '../../' . $class_name . '.php';
});

extract($_POST);

if(empty($nome) || empty($telefone) || empty($id)){
    header("Location: /");
}

use Models\Pessoa;
use Repository\PessoaRepository;

PessoaRepository::update(new Pessoa($id, $nome, $telefone));

header("Location: /pessoas");