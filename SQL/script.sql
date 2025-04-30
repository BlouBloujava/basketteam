CREATE DATABASE basket_site;

USE basket_site;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100),
  prenom VARCHAR(100),
  adresse TEXT,
  email VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  numero_bancaire TEXT NULL,
  date_expiration TEXT NULL,
  code_cvv TEXT NULL
);

CREATE TABLE produits (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  prix DECIMAL(10, 2) NOT NULL,
  image VARCHAR(255) NOT NULL
);

CREATE TABLE commandes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  produit_id INT NOT NULL,
  date_achat DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES utilisateurs(id),
  FOREIGN KEY (produit_id) REFERENCES produits(id)
);
