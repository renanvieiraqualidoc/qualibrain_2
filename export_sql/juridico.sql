CREATE TABLE produtos_juridico (
  id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  codigo INT(10) NOT NULL,
  descricao VARCHAR(200) NOT NULL,
  data DATETIME NOT NULL,
  url_monitor VARCHAR(80) NOT NULL,
  preco_custo FLOAT NOT NULL,
  website_monitorado VARCHAR(30) NOT NULL,
  url_monitorado VARCHAR(300) NOT NULL,
  hora TIME NOT NULL,
  preco_oferta FLOAT
);
