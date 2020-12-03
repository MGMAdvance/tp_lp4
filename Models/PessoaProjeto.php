<?php

namespace Models;

class PessoaProjeto implements Idados
{
	protected $pessoa;
	protected $projeto;

	public function __construct($pessoa, $projeto)
	{
		$this->pessoa = $pessoa;
		$this->projeto = $projeto;
	}

	public function toString()
	{
		return $this->pessoa . ' ' . $this->projeto;
	}

	public function toJson()
	{
		return json_encode([
			'pessoa' => $this->pessoa,
			'projeto' => $this->projeto
		]);
	}

	public static function toJsonEstatico($pessoa, $projeto)
	{
		return json_encode([
			'pessoa' => $pessoa,
			'projeto' => $projeto
		]);
	}

	public function getPessoa(){
		return $this->pessoa;
	}

	public function getProjeto(){
		return $this->projeto;
	}

	use trait__get;
}
