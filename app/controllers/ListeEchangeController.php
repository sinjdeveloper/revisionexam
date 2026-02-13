<?php

namespace app\controllers;

use flight\Engine;


class ListeEchangeController {

    protected Engine $app;

    public function __construct($app) {
        $this->app = $app;
    }

    public function getListeEchange() {
        $sql = "SELECT * FROM echanges";
        $stmt = $this->app->db()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $this->app->json($result);
    }

    public function getListeEchangeAppartenant($id){
        $sql = "SELECT * FROM echanges WHERE id_proprietaire = :id";
        $stmt = $this->app->db()->prepare($sql);
        $stmt->execute([':id' => (int)$id]);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $this->app->json($result);
    } 

    public function getListeEchangeurAppartenantEncours($id){
        $sql = "SELECT * FROM echanges WHERE id_echangeur = :id AND id_status = 1";
        $stmt = $this->app->db()->prepare($sql);
        $stmt->execute([':id' => (int)$id]);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $this->app->json($result);
    }
    
}
