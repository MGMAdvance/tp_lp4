CREATE TABLE `pessoas` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(200) NOT NULL,
  `telefone` VARCHAR(75) NOT NULL
);

CREATE TABLE `projetos` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(200) NOT NULL,
  `orcamento` VARCHAR(200) NOT NULL
);

CREATE TABLE `pessoa_projetos` (
  `pessoa_id` INT,
  `projeto_id` INT
);

CREATE TABLE `contratos` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `razao_social` VARCHAR(200) NOT NULL,
  `cnpj` VARCHAR(75) NOT NULL,
  `qt_valor` INT NOT NULL
);

ALTER TABLE `pessoa_projetos` ADD FOREIGN KEY (`pessoa_id`) REFERENCES `pessoas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `pessoa_projetos` ADD FOREIGN KEY (`projeto_id`) REFERENCES `projetos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

CREATE INDEX `pp_pessoa_id` ON `pessoa_projetos` (`pessoa_id`);

CREATE INDEX `pp_projetos_id` ON `pessoa_projetos` (`projeto_id`);
