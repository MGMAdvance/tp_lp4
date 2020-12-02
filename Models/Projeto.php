<?php

namespace Models;

class Projeto implements Idados
{
	protected $id;
	protected $descricao;
	protected $orcamento;

	public function __construct($id, $desc, $orcamento)
	{
		$this->id = $id;
		$this->descricao = $desc;
		$this->orcamento = $orcamento;
	}

	public function toString()
	{
		return $this->id . ' ' . $this->descricao . ' ' . $this->orcamento;
	}

	public function toJson()
	{
		return json_encode([
			'id' => $this->id,
			'descricao' => $this->descricao,
			'orcamento' => $this->orcamento
		]);
	}

	public static function toJsonEstatico($id, $descricao, $orcamento)
	{
		return json_encode([
			'id' => $id,
			'descricao' => $descricao,
			'orcamento' => $orcamento
		]);
	}

	public function getId(){
		return $this->id;
	}

	public function getDescricao(){
		return $this->desc;
	}

	public function getOrcamento(){
		return $this->orcamento;
	}

	use trait__get;
}
