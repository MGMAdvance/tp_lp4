<?php

namespace Models;

class Contrato implements Idados
{
	protected $id;
	protected $razaoSocial;
	protected $cnpj;
	protected $valor;

	public function __construct($id, $razaoSocial, $cnpj, $valor)
	{
		$this->id = $id;
		$this->razaoSocial = $razaoSocial;
		$this->cnpj = $cnpj;
		$this->valor = $valor;
	}

	public function toString()
	{
		return $this->id . ' ' . $this->razaoSocial . ' ' . $this->cnpj . ' ' . $this->valor;
	}

	public function toJson()
	{
		return json_encode([
			'id' => $this->id,
			'razaoSocial' => $this->razaoSocial,
			'cnpj' => $this->cnpj,
			'valor' => $this->valor
		]);
	}

	public static function toJsonEstatico($id, $razaoSocial, $cnpj, $valor)
	{
		return json_encode([
			'id' => $id,
			'razaoSocial' => $razaoSocial,
			'cnpj' => $cnpj,
			'valor' => $valor
		]);
	}

	public function getId(){
		return $this->id;
	}

	public function getRazaoSocial(){
		return $this->razaoSocial;
	}

	public function getCnpj(){
		return $this->cnpj;
	}

	public function getValor(){
		return $this->valor;
	}

	use trait__get;
}
