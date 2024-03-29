<?php
namespace App\Models;

class Reservation{

    private $Id_reservation;         
    private $Nombre_reservation;       
    private $Enfants_reservation;      
    private $NombreCasque_reservation; 
    private $NombreLuge_reservation;   
    private $PrixTotal_reservation;    
    private $Id_user ;                 
    private $Id_pass;       

    public function __construct(array $data = [])
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
    }
    /**
     * Get the value of Id_reservation
     */ 
    public function getId_reservation()
    {
        return $this->Id_reservation;
    }

    /**
     * Set the value of Id_reservation
     *
     * @return  self
     */ 
    public function setId_reservation($Id_reservation)
    {
        $this->Id_reservation = $Id_reservation;

        return $this;
    }

    /**
     * Get the value of Nombre_reservation
     */ 
    public function getNombre_reservation()
    {
        return $this->Nombre_reservation;
    }

    /**
     * Set the value of Nombre_reservation
     *
     * @return  self
     */ 
    public function setNombre_reservation($Nombre_reservation)
    {
        $this->Nombre_reservation = $Nombre_reservation;

        return $this;
    }

    /**
     * Get the value of Enfants_reservation
     */ 
    public function getEnfants_reservation()
    {
        return $this->Enfants_reservation;
    }

    /**
     * Set the value of Enfants_reservation
     *
     * @return  self
     */ 
    public function setEnfants_reservation($Enfants_reservation)
    {
        $this->Enfants_reservation = $Enfants_reservation;

        return $this;
    }

    /**
     * Get the value of NombreCasque_reservation
     */ 
    public function getNombreCasque_reservation()
    {
        return $this->NombreCasque_reservation;
    }

    /**
     * Set the value of NombreCasque_reservation
     *
     * @return  self
     */ 
    public function setNombreCasque_reservation($NombreCasque_reservation)
    {
        $this->NombreCasque_reservation = $NombreCasque_reservation;

        return $this;
    }

    /**
     * Get the value of NombreLuge_reservation
     */ 
    public function getNombreLuge_reservation()
    {
        return $this->NombreLuge_reservation;
    }

    /**
     * Set the value of NombreLuge_reservation
     *
     * @return  self
     */ 
    public function setNombreLuge_reservation($NombreLuge_reservation)
    {
        $this->NombreLuge_reservation = $NombreLuge_reservation;

        return $this;
    }

    /**
     * Get the value of PrixTotal_reservation
     */ 
    public function getPrixTotal_reservation()
    {
        return $this->PrixTotal_reservation;
    }

    /**
     * Set the value of PrixTotal_reservation
     *
     * @return  self
     */ 
    public function setPrixTotal_reservation($PrixTotal_reservation)
    {
        $this->PrixTotal_reservation = $PrixTotal_reservation;

        return $this;
    }

    /**
     * Get the value of Id_user
     */ 
    public function getId_user()
    {
        return $this->Id_user;
    }

    /**
     * Set the value of Id_user
     *
     * @return  self
     */ 
    public function setId_user($Id_user)
    {
        $this->Id_user = $Id_user;

        return $this;
    }

    /**
     * Get the value of Id_pass
     */ 
    public function getId_pass()
    {
        return $this->Id_pass;
    }

    /**
     * Set the value of Id_pass
     *
     * @return  self
     */ 
    public function setId_pass($Id_pass)
    {
        $this->Id_pass = $Id_pass;

        return $this;
    }
}