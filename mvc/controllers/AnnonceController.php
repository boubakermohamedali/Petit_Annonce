<?php
class Annonce
{
  private $id_annonce;
  private $Title;
  private $description_annonces;
  private $Prix_vente;
  private $date_vente;
  private $cont_annonce;
  private $id_etat;
  private $id_membre_1;
  private $id_membre;
  private $date_creation;
  private $duree_publication;
  private $Date_validation;
  private $date_fin_publication;
  // function getter 
  public function getDateValidation(){
    return $this->Date_validation;
  }
   public function getdureePublication(){
    return $this->duree_publication;
  }
   public function getcont_annonce(){
    return $this->cont_annonce;
  }
  public function id_annonce(){
    return $this->id_annonce;
  }
    public function getdate_creation(){
    return $this-> date_creation;
  }
     public function getdate_fin_publication(){
    return $this->date_fin_publication ;
  }

  public function getid_membre(){
    return $this->id_membre;
  }
 public function getid_membre_1(){
    return $this->id_membre_1;
  }

  public function getid_etat(){
    return $this->id_etat;
  }

  public function getTitle(){
    return $this->Title;
  }
  public function getPrix_vente(){
    return $this->Prix_vente;
  }
  public function getdate_vente(){
    return $this->date_vente;
  }
  public function getdescription_annonces(){
    return $this->description_annonces;
  }
 // Function setter  
  public function setTitle($Title){
    $this->Title=$Title;
  }
 
  public function setDescription($date_vente){
    $this->date_vente=$date_vente;
  }
 
  public function setPrix($Prix_vente){
    $this->Prix_vente=$Prix_vente;
  }
    }