<?php
namespace Repository;

use Models\Pessoa;
use Models\Projeto;
use Models\PessoaProjeto;
use Models\Contrato;

interface IPessoaRepository{
	public static function insert(Pessoa $pessoa): void;
    public static function update(Pessoa $pessoa): void;
    public static function delete($id): void;
    public static function getAll();
    public static function getById($id): Pessoa;
}

interface IProjetoRepository{
	public static function insert(Projeto $projeto): void;
    public static function update(Projeto $projeto): void;
    public static function delete($id): void;
    public static function getAll();
    public static function getById($id): Projeto;
}

interface IPessoaProjetoRepository{
	public static function insert(PessoaProjeto $pp): void;
    public static function update(PessoaProjeto $pp): void;
    public static function delete($pessoa, $projeto): void;
    public static function getAll();
    public static function getById($pessoa, $projeto): PessoaProjeto;
}

interface IContratoRepository{
	public static function insert(Contrato $contrato): void;
    public static function update(Contrato $contrato): void;
    public static function delete($id): void;
    public static function getAll();
    public static function getById($id): Contrato;
}
