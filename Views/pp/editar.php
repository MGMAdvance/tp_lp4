<?php
spl_autoload_register(function ($class_name) {
    include '../../' . $class_name . '.php';
});

extract($_POST);

if(empty($pessoa) || empty($projeto)){
    header("Location: /");
}

use Models\PessoaProjeto;
use Repository\PessoaProjetoRepository;

PessoaProjetoRepository::update(new PessoaProjeto($pessoa, $projeto));

header("Location: /pp");