<?php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

use Repository\PessoaRepository;

$pessoa = PessoaRepository::getAll();

var_dump($pessoa[0]->toJson());
require "components/header.php";
?>

<div class="container content mt-5 mb-5">
  <div class="row d-flex justify-content-center">
    <div class="jumbotron text-center mb-0" id="banner">
      <h4>Fatec Praia Grande</h4>
      <h5>Linguagem de programação IV - Noturno</h5>
    </div>
  </div>
</div>

<?php require "components/footer.php";?>