<?php

namespace app\models;

use Flight;

class Echange
{
    private $id;
    private $id_proprietaire;
    private $id_echangeur;
    private $id_produit_proprietaire;
    private $id_produit_echangeur;
    private $id_status;

    public function __construct($id_proprietaire = null, $id_echangeur = null, $id_produit_proprietaire = null, $id_produit_echangeur = null, $id_status = null, $id = null)
    {
        $this->id_proprietaire = $id_proprietaire;
        $this->id_echangeur = $id_echangeur;
        $this->id_produit_proprietaire = $id_produit_proprietaire;
        $this->id_produit_echangeur = $id_produit_echangeur;
        $this->id_status = $id_status;
        $this->id = $id;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getProprietaire()
    {
        return $this->id_proprietaire;
    }

    public function getEchangeur()
    {
        return $this->id_echangeur;
    }

    public function getProduitProprietaire()
    {
        return $this->id_produit_proprietaire;
    }

    public function getProduitEchangeur()
    {
        return $this->id_produit_echangeur;
    }

    public function getStatus()
    {
        return $this->id_status;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setProprietaire($proprietaire)
    {
        $this->id_proprietaire = $proprietaire;
    }

    public function setEchangeur($echangeur)
    {
        $this->id_echangeur = $echangeur;
    }

    public function setProduitProprietaire($produitProprietaire)
    {
        $this->id_produit_proprietaire = $produitProprietaire;
    }

    public function setProduitEchangeur($produitEchangeur)
    {
        $this->id_produit_echangeur = $produitEchangeur;
    }

    public function setStatus($status)
    {
        $this->id_status = $status;
    }
}