-- Insertion des utilisateurs
INSERT INTO users (username, email, password_hash, created_at) VALUES 
('alice', 'alice@example.com', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86AGR0wqhHe', NOW()),
('bob', 'bob@example.com', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86AGR0wqhHe', NOW()),
('charlie', 'charlie@example.com', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86AGR0wqhHe', NOW());

-- Insertion des catégories
INSERT INTO categorie (nom) VALUES 
('Électronique'),
('Vêtements'),
('Livres'),
('Meubles'),
('Sports'),
('Jouets');

-- Insertion des status
INSERT INTO status (nom) VALUES 
('En attente'),
('Accepté'),
('Rejeté'),
('Complété');

-- Insertion des produits
INSERT INTO produits (nom, description, id_proprietaire, id_categorie, prix, disponible, created_at) VALUES 
('Smartphone Samsung', 'Samsung Galaxy S21, 256GB, excellent état', 1, 1, 400.00, TRUE, NOW()),
('Laptop Dell XPS', 'Dell XPS 13, i7, 16GB RAM, SSD 512GB', 1, 1, 800.00, TRUE, NOW()),
('Montre Apple Watch', 'Apple Watch Series 7, GPS, 45mm', 1, 1, 250.00, TRUE, NOW()),
('Veste en Cuir', 'Veste en cuir noir vintage, taille M', 2, 2, 120.00, TRUE, NOW()),
('Jeans Levi''s', 'Jean Levi''s 501, bleu classique, taille 32', 2, 2, 60.00, TRUE, NOW()),
('T-shirt Coton', 'T-shirt blanc coton pur, taille L', 2, 2, 25.00, TRUE, NOW()),
('Harry Potter Box Set', 'Collection complète 7 livres en français', 3, 3, 85.00, TRUE, NOW()),
('Le Seigneur des Anneaux', 'Trilogie LOTR, édition de poche', 3, 3, 45.00, FALSE, NOW()),
('Table à Manger', 'Table bois massif 6 places, très bon état', 1, 4, 300.00, TRUE, NOW()),
('Chaise de Bureau', 'Chaise ergonomique ajustable, noire', 2, 4, 150.00, TRUE, NOW()),
('Vélo de Route', 'Trek FX 3, 21 vitesses, 2021', 3, 5, 450.00, TRUE, NOW()),
('Raquette Tennis', 'Wilson Pro Staff Racket, professionnel', 1, 5, 200.00, FALSE, NOW()),
('Nintendo Switch', 'Console avec manettes Joy-Con rouge/bleu', 2, 6, 280.00, TRUE, NOW()),
('Playmobil City', 'Grand coffret Playmobil avec 200+ pièces', 3, 6, 40.00, TRUE, NOW()),
('Appareil Photo Canon', 'Canon EOS 5D Mark IV, 24.1 MP avec objectif', 1, 1, 1200.00, TRUE, NOW());
