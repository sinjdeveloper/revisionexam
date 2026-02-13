<?php

namespace app\controllers;

use flight\Engine;


class ListeUserController {
    protected Engine $app;

    public function __construct($app) {
        $this->app = $app;
    }

    public function getListeUser() {
        $sql = "SELECT * FROM users";
        $stmt = $this->app->db()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $this->app->json($result);
    }
}
