<?php
namespace Repository;

include 'IRepository.php';

use \PDO;
use \PDOException;
use Models\Contrato;

require 'config.php';

class ContratoRepository implements IContratoRepository
{
    public static function insert(Contrato $contrato): void
    {
        try {
            $pdo = new PDO(HOST, USER, PASS);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

            $razaoSocial = $contrato->getRazaoSocial();
            $cnpj = $contrato->getCnpj();
            $valor = $contrato->getValor();

            $stmt = $pdo->prepare('INSERT INTO contratos (razao_social, cnpj, qt_valor) VALUES (:razaoSocial,:cnpj,:valor)');
            $stmt->bindParam(':razaoSocial', $razaoSocial);
            $stmt->bindParam(':cnpj', $cnpj);
            $stmt->bindParam(':valor', $valor);

            $stmt->execute();
        } catch (PDOException $ex) {
        } finally {
            $pdo = null;
        }
    }

    public static function getAll()
    {        
        try {
            $pdo = new PDO(HOST, USER, PASS);

            $data = $pdo->query("SELECT * FROM contratos");

            $contratos = [];

            foreach ($data as $row) {
                array_push($contratos, new Contrato($row['id'], $row['razao_social'], $row['cnpj'], $row['qt_valor']));
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        } finally {
            $pdo = null;
        }

        return $contratos;
    }

    public static function getById($id): Contrato
    {
        try {
            $pdo = new PDO(HOST, USER, PASS);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

            $stmt = $pdo->prepare('SELECT * FROM projetos WHERE id=:i');
            $stmt->bindParam(':i', $id);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $linha = $stmt->fetchAll();

            $contrato = new Contrato(
                $linha[0]['id'],
                $linha[0]['razao_social'],
                $linha[0]['cnpj'],
                $linha[0]['qt_valor']
            );
        } catch (PDOException $ex) {

        } finally {
            $pdo = null;
        }

        return $contrato;
    }

    public static function update(Contrato $contrato): void
    {
        try {
            $pdo = new PDO(HOST, USER, PASS);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

            $stmt = $pdo->prepare('UPDATE contratos SET razao_social=:razaoSocial, cnpj=:cnpj, qt_valor=:valor WHERE id=:id');

            $id = $contrato->getId();
            $razaoSocial = $contrato->getRazaoSocial();
            $cnpj = $contrato->getCnpj();
            $valor = $contrato->getValor();

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':razaoSocial', $razaoSocial);
            $stmt->bindParam(':cnpj', $cnpj);
            $stmt->bindParam(':valor', $valor);

            $stmt->execute();
        } catch (PDOException $ex) {
        } finally {
            $pdo = null;
        }
    }

    public static function delete($id): void
    {
        try {
            $pdo = new PDO(HOST, USER, PASS);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

            $stmt = $pdo->prepare('DELETE FROM contratos WHERE id=:id');

            $stmt->bindParam(':id', $id);

            $stmt->execute();
        } catch (PDOException $ex) {
        } finally {
            $pdo = null;
        }
    }
}
