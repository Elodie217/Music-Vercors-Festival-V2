<?php

namespace App\Models;


class User
{

    private $Id_pass;
    private $Prix_pass;
    private $Pass_pass;
    private $Date_pass;
    private $TarifReduit_pass;


    function __construct(array $datas = array())
    {
        foreach ($datas as $key => $value) {
            $this->$key = $value;
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
     */
    public function setId_pass($Id_pass): self
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
     */
    public function setPrix_pass($Prix_pass): self
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
     */
    public function setPass_pass($Pass_pass): self
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
     */
    public function setDate_pass($Date_pass): self
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
     */
    public function setTarifReduit_pass($TarifReduit_pass): self
    {
        $this->TarifReduit_pass = $TarifReduit_pass;

        return $this;
    }
}
