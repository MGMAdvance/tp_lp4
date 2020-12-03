<?php

namespace Repository;

include 'IRepository.php';

use \PDO;
use \PDOException;
use Models\PessoaProjeto;
use Models\Pessoa;
use Models\Projeto;

require 'config.php';

class PessoaProjetoRepository implements IPessoaProjetoRepository
{
    public static function insert(PessoaProjeto $pp): void
    {
        try {
            $pdo = new PDO(HOST, USER, PASS);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

            $pessoa = $pp->getPessoa();
            $projeto = $pp->getProjeto();

            $stmt = $pdo->prepare('INSERT INTO pessoa_projetos (pessoa_id,projeto_id) VALUES (:pessoa, :projeto)');
            $stmt->bindParam(':pessoa', $pessoa);
            $stmt->bindParam(':projeto', $projeto);

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

            $data = $pdo->query("SELECT * FROM `pessoa_projetos` 
                                INNER JOIN `pessoas` ON `pessoa_projetos`.`pessoa_id` = `pessoas`.`id` 
                                INNER JOIN `projetos` ON `pessoa_projetos`.`projeto_id` = `projetos`.`id`");

            $pp = [];

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

            foreach ($data as $row) {
                array_push($pp, $row);
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        } finally {
            $pdo = null;
        }

        return $pp;
    }

    public static function getById($pessoa, $projeto): PessoaProjeto
    {
        try {
            $pdo = new PDO(HOST, USER, PASS);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

            $stmt = $pdo->prepare('SELECT * FROM pessoa_projetos 
                                    INNER JOIN `pessoas` ON `pessoa_projetos`.`pessoa_id` = `pessoas`.`id` 
                                    INNER JOIN `projetos` ON `pessoa_projetos`.`projeto_id` = `projetos`.`id`
                                    WHERE pessoa_projetos.pessoa_id=:pessoa AND pessoa_projetos.projeto_id=:projeto');
            $stmt->bindParam(':pessoa', $pessoa);
            $stmt->bindParam(':projeto', $projeto);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $linha = $stmt->fetchAll();

            $pessoa = new PessoaProjeto(
                $linha[0]['pessoa_id'],
                $linha[0]['projeto_id']
            );

            $pessoa->setPessoaNome($linha[0]['nome']);
            $pessoa->setProjetoNome($linha[0]['descricao']);
        } catch (PDOException $ex) {
        } finally {
            $pdo = null;
        }

        return $pessoa;
    }

    public static function update(PessoaProjeto $pp): void
    {
        try {
            $pdo = new PDO(HOST, USER, PASS);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

            $stmt = $pdo->prepare('UPDATE pessoa_projetos SET pessoa_id=:pessoa, projeto_id=:projeto WHERE pessoa_id=:pessoa AND projeto_id=:projeto');

            $pessoa = $pp->getPessoa();
            $projeto = $pp->getProjeto();

            $stmt->bindParam(':pessoa_id', $pessoa);
            $stmt->bindParam(':projeto_id', $projeto);

            $stmt->execute();
        } catch (PDOException $ex) {
        } finally {
            $pdo = null;
        }
    }

    public static function delete($pessoa, $projeto): void
    {
        try {
            $pdo = new PDO(HOST, USER, PASS);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

            $stmt = $pdo->prepare('DELETE FROM pessoa_projetos WHERE pessoa_id=:pessoa AND projeto_id=:projeto');

            $stmt->bindParam(':pessoa_id', $pessoa);
            $stmt->bindParam(':projeto_id', $projeto);

            $stmt->execute();
        } catch (PDOException $ex) {
        } finally {
            $pdo = null;
        }
    }

    public static function getPessoaNomes()
    {
        try {
            $pdo = new PDO(HOST, USER, PASS);

            $data = $pdo->query("SELECT * FROM pessoas");

            $pessoas = [];

            foreach ($data as $v) {
                array_push($pessoas, new Pessoa($v['id'], $v['nome'], $v['telefone']));
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        } finally {
            $pdo = null;
        }

        return $pessoas;
    }

    public static function getProjetosNomes()
    {
        try {
            $pdo = new PDO(HOST, USER, PASS);

            $data = $pdo->query("SELECT * FROM projetos");

            $projetos = [];

            foreach ($data as $v) {
                array_push($projetos, new Projeto($v['id'], $v['descricao'], $v['orcamento']));
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        } finally {
            $pdo = null;
        }

        return $projetos;
    }
}
