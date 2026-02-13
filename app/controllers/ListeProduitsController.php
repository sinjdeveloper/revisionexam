<?php

namespace app\controllers;

use flight\Engine;

class ListeProduitsController {

    protected Engine $app;

    public function __construct($app) {
        $this->app = $app;
    }

    public function getListeProduits() {
        $sql = "SELECT * FROM produits";
        $stmt = $this->app->db()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $this->app->json($result);
    }

    public function getListeProduitsAppartenant($id){
        $sql = "SELECT * FROM produits WHERE id_proprietaire = :id";
        $stmt = $this->app->db()->prepare($sql);
        $stmt->execute([':id' => (int)$id]);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $this->app->json($result);
    }
}
