<?php

namespace app\controllers;

use app\models\Admins;
use Flight;

class LoginAdminController
{
    public function showLogin()
    {
        return Flight::view()->render('login');
    }

    public function login()
    {
        $email = trim(filter_var(Flight::request()->data->email ?? '', FILTER_SANITIZE_EMAIL));
        $password = trim(Flight::request()->data->password ?? '');

        // Validation des données
        if (empty($email) || empty($password)) {
            Flight::json([
                'success' => false,
                'message' => 'Email et mot de passe sont requis'
            ], 400);
            return;
        }

        // DEBUG
        error_log("Login attempt - Email: $email, Password length: " . strlen($password));

        // Authentification
        $admin = Admins::authenticate($email, $password);

        if ($admin) {
            // Créer une session admin
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['user_id'] = $admin->getId();
            $_SESSION['user_email'] = $admin->getEmail();
            $_SESSION['user_name'] = $admin->getName();

            error_log("Login successful for admin: " . $admin->getName());

            // Retourner JSON avec succès et redirection
            Flight::json([
                'success' => true,
                'message' => 'Connexion réussie',
                'redirect' => '/analytics'
            ], 200);
        } else {
            error_log("Authentication failed for email: $email");
            Flight::json([
                'success' => false,
                'message' => 'Email ou mot de passe incorrect'
            ], 401);
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();

        Flight::json([
            'success' => true,
            'message' => 'Déconnexion réussie'
        ], 200);
    }

    public function register()
    {
        $username = trim(htmlspecialchars(Flight::request()->data->username ?? ''));
        $email = trim(filter_var(Flight::request()->data->email ?? '', FILTER_SANITIZE_EMAIL));
        $password = trim(Flight::request()->data->password ?? '');

        // Validation des données
        if (empty($username) || empty($email) || empty($password)) {
            Flight::json([
                'success' => false,
                'message' => 'Tous les champs sont requis'
            ], 400);
            return;
        }

        // Validation du format email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Flight::json([
                'success' => false,
                'message' => 'Email invalide'
            ], 400);
            return;
        }

        // Validation du mot de passe
        if (strlen($password) < 8) {
            Flight::json([
                'success' => false,
                'message' => 'Le mot de passe doit contenir au moins 8 caractères'
            ], 400);
            return;
        }

        // Vérifier si l'admin existe déjà
        $existingAdmin = Admins::findByEmail($email);
        if ($existingAdmin) {
            Flight::json([
                'success' => false,
                'message' => 'Un admin avec cet email existe déjà'
            ], 409);
            return;
        }

        // Hasher le mot de passe
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Créer le nouvel admin
        try {
            $db = Flight::db();
            $stmt = $db->prepare('INSERT INTO admins (username, email, password_hash, created_at) VALUES (:username, :email, :password_hash, NOW())');
            $stmt->execute([
                ':username' => $username,
                ':email' => $email,
                ':password_hash' => $passwordHash
            ]);

            // Créer une session pour le nouvel admin
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['user_id'] = $db->lastInsertId();
            $_SESSION['user_email'] = $email;
            $_SESSION['user_name'] = $username;

            Flight::json([
                'success' => true,
                'message' => 'Inscription réussie! Veuillez vous connecter.'
            ], 201);
        } catch (\Exception $e) {
            error_log("Admin registration error: " . $e->getMessage());
            Flight::json([
                'success' => false,
                'message' => 'Erreur lors de l\'inscription de l\'admin'
            ], 500);
        }
    }

    public function getCurrentUser()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user_id'])) {
            Flight::json([
                'success' => true,
                'user' => [
                    'id' => $_SESSION['user_id'],
                    'email' => $_SESSION['user_email'],
                    'name' => $_SESSION['user_name']
                ]
            ], 200);
        } else {
            Flight::json([
                'success' => false,
                'message' => 'Admin non connecté'
            ], 401);
        }
    }
}
