<?php
spl_autoload_register(function ($class_name) {
    include '../../' . $class_name . '.php';
});

extract($_POST);

if(empty($razaoSocial) || empty($cnpj) || empty($valor) || empty($id)){
    header("Location: /");
}

use Models\Contrato;
use Repository\ContratoRepository;

ContratoRepository::update(new Contrato($id, $razaoSocial, $cnpj, $valor));

header("Location: /contratos");