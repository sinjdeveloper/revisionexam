-- Active: 1767705706205@@127.0.0.1@5432@echange
CREATE DATABASE echange;

CREATE TABLE users(
    id SERIAL PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE admins(
    id SERIAL PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categorie(
    id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE produits(
    id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    id_categorie INT REFERENCES categorie(id),
    prix DECIMAL(10, 2) NOT NULL,
    disponible BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE status(
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL
);

CREATE TABLE echange(
    id SERIAL PRIMARY KEY,
    id_produit INT REFERENCES produits(id),
    id_proprietaire INT REFERENCES users(id),
    id_acheteur INT REFERENCES users(id),
    id_status INT REFERENCES status(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

