<?php
namespace Repository;

use \PDO;
use \PDOException;
use Models\Pessoa;

require 'config.php';

class PessoaRepository
{
    public static function insert(Pessoa $pessoa): void
    {
        try {
            $pdo = new PDO(HOST, USER, PASS);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

            $nome = $pessoa->getNome();
            $telefone = $pessoa->getTelefone();

            $stmt = $pdo->prepare('INSERT INTO pessoas (nome,telefone) VALUES (:nome,:telefone)');
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':telefone', $telefone);

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

            $data = $pdo->query("SELECT * FROM pessoas");

            $pessoas = [];

            foreach ($data as $v) {
                array_push($pessoas, new Pessoa($v['id'], $v['nome'], $v['telefone'], null));
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        } finally {
            $pdo = null;
        }

        return $pessoas;
    }

    public static function getById($id): Pessoa
    {
        try {
            $pdo = new PDO(HOST, USER, PASS);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

            $stmt = $pdo->prepare('SELECT id, nome, telefone FROM pessoas WHERE id=:i');
            $stmt->bindParam(':i', $id);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $linha = $stmt->fetchAll();

            $pessoa = new Pessoa(
                $linha[0]['id'],
                $linha[0]['nome'],
                $linha[0]['telefone'],
                null
            );
        } catch (PDOException $ex) {

        } finally {
            $pdo = null;
        }

        return $pessoa;
    }

    public static function update(Pessoa $pessoa): void
    {
        try {
            $pdo = new PDO(HOST, USER, PASS);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

            $stmt = $pdo->prepare('UPDATE pessoas SET nome=:nome, telefone=:tel WHERE id=:id');

            $id = $pessoa->getId();
            $nome = $pessoa->getNome();
            $telefone = $pessoa->getTelefone();

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':tel', $telefone);

            $stmt->execute();
        } catch (PDOException $pex) {
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

            $stmt = $pdo->prepare('DELETE FROM pessoas WHERE id=:id');

            $stmt->bindParam(':id', $id);

            $stmt->execute();
        } catch (PDOException $ex) {
        } finally {
            $pdo = null;
        }
    }
}
