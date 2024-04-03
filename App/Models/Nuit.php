<?php
namespace App\Models;

class Nuit
{
    private $Id_nuit;
    private $Prix_nuit;
    private $Type_nuit;
    private $Date_nuit;

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
     * Get the value of Id_nuit
     */ 
    public function getId_nuit()
    {
        return $this->Id_nuit;
    }

    /**
     * Set the value of Id_nuit
     *
     * @return  self
     */ 
    public function setId_nuit($Id_nuit)
    {
        $this->Id_nuit = $Id_nuit;

        return $this;
    }

    /**
     * Get the value of Prix_nuit
     */ 
    public function getPrix_nuit()
    {
        return $this->Prix_nuit;
    }

    /**
     * Set the value of Prix_nuit
     *
     * @return  self
     */ 
    public function setPrix_nuit($Prix_nuit)
    {
        $this->Prix_nuit = $Prix_nuit;

        return $this;
    }

    /**
     * Get the value of Type_nuit
     */ 
    public function getType_nuit()
    {
        return $this->Type_nuit;
    }

    /**
     * Set the value of Type_nuit
     *
     * @return  self
     */ 
    public function setType_nuit($Type_nuit)
    {
        $this->Type_nuit = $Type_nuit;

        return $this;
    }

    /**
     * Get the value of Date_nuit
     */ 
    public function getDate_nuit()
    {
        return $this->Date_nuit;
    }

    /**
     * Set the value of Date_nuit
     *
     * @return  self
     */ 
    public function setDate_nuit($Date_nuit)
    {
        $this->Date_nuit = $Date_nuit;

        return $this;
    }
}