<?php
spl_autoload_register(function ($class_name) {
    include '../../' . $class_name . '.php';
});

extract($_POST);

if(empty($id)){
    header("Location: /");
}

use Repository\PessoaRepository;

PessoaRepository::delete($id);

header("Location: /pessoas");