<?php
namespace App\Models;

class Pass
{

    private $Id_pass;
    private $Prix_pass;
    private $Pass_pass;
    private $Date_pass;
    private $TarifReduit_pass;

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

    /**
     * Get the value of Prix_pass
     */ 

    public function getPrix_pass()
    {
        return $this->Prix_pass;
    }

    /**
     * Set the value of Prix_pass
     *
     * @return  self
     */ 
    public function setPrix_pass($Prix_pass)

    {
        $this->Prix_pass = $Prix_pass;

        return $this;
    }

    /**
     * Get the value of Pass_pass
     */ 

    public function getPass_pass()
    {
        return $this->Pass_pass;
    }

    /**
     * Set the value of Pass_pass
     *
     * @return  self
     */ 
    public function setPass_pass($Pass_pass)

    {
        $this->Pass_pass = $Pass_pass;

        return $this;
    }

    /**
     * Get the value of Date_pass
     */ 

    public function getDate_pass()
    {
        return $this->Date_pass;
    }

    /**
     * Set the value of Date_pass
     *
     * @return  self
     */ 
    public function setDate_pass($Date_pass)

    {
        $this->Date_pass = $Date_pass;

        return $this;
    }

    /**
     * Get the value of TarifReduit_pass
     */ 

    public function getTarifReduit_pass()
    {
        return $this->TarifReduit_pass;
    }

    /**
     * Set the value of TarifReduit_pass
     *
     * @return  self
     */ 
    public function setTarifReduit_pass($TarifReduit_pass)

    {
        $this->TarifReduit_pass = $TarifReduit_pass;

        return $this;
    }
}

