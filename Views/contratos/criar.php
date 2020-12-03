<?php
spl_autoload_register(function ($class_name) {
    include '../../' . $class_name . '.php';
});

extract($_POST);

if(empty($razaoSocial) || empty($cnpj || empty($valor))){
    header("Location: /");
}

use Models\Contrato;
use Repository\ContratoRepository;

ContratoRepository::insert(new Contrato(null, $razaoSocial, $cnpj, $valor));

header("Location: /contratos");