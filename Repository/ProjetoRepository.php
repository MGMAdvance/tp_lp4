<?php
namespace Repository;

include 'IRepository.php';

use \PDO;
use \PDOException;
use Models\Projeto;

require 'config.php';

class ProjetoRepository implements IProjetoRepository
{
    public static function insert(Projeto $projeto): void
    {
        try {
            $pdo = new PDO(HOST, USER, PASS);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

            $descricao = $projeto->getDescricao();
            $orcamento = $projeto->getOrcamento();

            $stmt = $pdo->prepare('INSERT INTO projetos (descricao,orcamento) VALUES (:descricao, :orcamento)');
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':orcamento', $orcamento);

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

            $data = $pdo->query("SELECT * FROM projetos");

            $projetos = [];

            foreach ($data as $row) {
                array_push($projetos, new Projeto($row['id'], $row['descricao'], $row['orcamento']));
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        } finally {
            $pdo = null;
        }

        return $projetos;
    }

    public static function getById($id): Projeto
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

            $pessoa = new Projeto(
                $linha[0]['id'],
                $linha[0]['descricao'],
                $linha[0]['orcamento']
            );
        } catch (PDOException $ex) {

        } finally {
            $pdo = null;
        }

        return $pessoa;
    }

    public static function update(Projeto $projeto): void
    {
        try {
            $pdo = new PDO(HOST, USER, PASS);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

            $stmt = $pdo->prepare('UPDATE projetos SET descricao=:descricao, orcamento=:orcamento WHERE id=:id');

            $id = $projeto->getId();
            $descricao = $projeto->getDescricao();
            $orcamento = $projeto->getOrcamento();

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':orcamento', $orcamento);

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

            $stmt = $pdo->prepare('DELETE FROM projetos WHERE id=:id');

            $stmt->bindParam(':id', $id);

            $stmt->execute();
        } catch (PDOException $ex) {
        } finally {
            $pdo = null;
        }
    }
}
