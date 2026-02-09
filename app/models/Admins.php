<?php


namespace app\models;

use Flight;

class Admins
{
    private $id;
    private $email;
    private $password_hash;
    private $username;

    public function __construct($email = null, $password_hash = null, $username = null, $id = null)
    {
        $this->email = $email;
        $this->password_hash = $password_hash;
        $this->username = $username;
        $this->id = $id;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password_hash;
    }

    public function getName()
    {
        return $this->username;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password_hash = $password;
    }

    public function setName($name)
    {
        $this->username = $name;
    }

    // Authentification
    public function verifyPassword($password)
    {
        return password_verify($password, $this->password_hash);
    }

    public function hashPassword()
    {
        $this->password_hash = password_hash($this->password_hash, PASSWORD_DEFAULT);
    }

    // Simulated users database (you can replace this with real database calls)
    public static function findByEmail($email)
    {
        try {
            $stmt = Flight::db()->prepare('SELECT id, email, password_hash, username FROM users WHERE email = :email LIMIT 1');
            $stmt->execute([':email' => $email]);
            $userData = $stmt->fetch();

            if ($userData) {
                error_log("User found: " . $userData['email']);
                return new self(
                    $userData['email'],
                    $userData['password_hash'],
                    $userData['username'],
                    $userData['id']
                );
            }

            error_log("User NOT found for email: $email");
            return null;
        } catch (\Exception $e) {
            error_log('Database error in findByEmail: ' . $e->getMessage());
            return null;
        }
    }

    public static function findById($id)
    {
        try {
            $stmt = Flight::db()->prepare('SELECT id, email, password_hash, username FROM users WHERE id = :id LIMIT 1');
            $stmt->execute([':id' => $id]);
            $userData = $stmt->fetch();

            if ($userData) {
                return new self(
                    $userData['email'],
                    $userData['password_hash'],
                    $userData['username'],
                    $userData['id']
                );
            }

            return null;
        } catch (\Exception $e) {
            error_log('Database error in findById: ' . $e->getMessage());
            return null;
        }
    }

    public static function authenticate($email, $password)
    {
        $user = self::findByEmail($email);

        if ($user) {
            $hashFromDb = $user->getPassword();
            $passwordMatch = password_verify($password, $hashFromDb);
            error_log("Password verify result: " . ($passwordMatch ? 'TRUE' : 'FALSE'));
            error_log("Hash from DB: " . substr($hashFromDb, 0, 30) . "...");
            
            if ($passwordMatch) {
                return $user;
            }
        }

        return null;
    }
}
