<?php
spl_autoload_register(function ($class_name) {
    include '../../' . $class_name . '.php';
});

extract($_POST);

if(empty($nome) || empty($telefone)){
    header("Location: /");
}

use Models\Pessoa;
use Repository\PessoaRepository;

PessoaRepository::insert(new Pessoa(null, $nome, $telefone));

header("Location: /pessoas");