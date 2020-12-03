<?php

namespace Models;

class PessoaProjeto implements Idados
{
	protected $pessoa;
	protected $projeto;
	protected $pessoaNome;
	protected $projetoNome;

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

	public function getPessoaNome(){
		return $this->pessoaNome;
	}

	public function getProjetoNome(){
		return $this->projetoNome;
	}

	public function setPessoaNome($nome){
		$this->pessoaNome = $nome;
	}

	public function setProjetoNome($nome){
		$this->projetoNome = $nome;
	}

	use trait__get;
}
