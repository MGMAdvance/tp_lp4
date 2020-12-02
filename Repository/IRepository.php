<?php
namespace Repository;

use Models\Pessoa;

interface IPessoaRepository{
	public static function insert(Pessoa $pessoa): void;
    public static function update(Pessoa $pessoa): void;
    public static function delete($id): void;
    public static function getAll();
    public static function getById($id): Pessoa;
}

interface IProjetoRepository{
	public static function insert(): void;
    public static function update(Pessoa $pessoa): void;
    public static function delete($id): void;
    public static function getAll();
    public static function getById($id): Pessoa;
}

interface IPPRepository{
	public static function insert(): void;
    public static function update(Pessoa $pessoa): void;
    public static function delete($id): void;
    public static function getAll();
    public static function getById($id): Pessoa;
}

interface IContratoRepository{
	public static function insert(): void;
    public static function update(Pessoa $pessoa): void;
    public static function delete($id): void;
    public static function getAll();
    public static function getById($id): Pessoa;
}
