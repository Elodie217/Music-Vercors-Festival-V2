<?php

namespace App\Models;


class User
{

    private $Id_user;
    private $Nom_user;
    private $Prenom_user;
    private $Email_user;
    private $Telephone_user;
    private $AdressePostale_user;
    private $MotDePasse_user;
    private $Role_user;
    private $DateRGPD;


    function __construct(array $datas = array())
    {
        foreach ($datas as $key => $value) {
            $this->$key = $value;
        }
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
     */
    public function setId_user($Id_user): self
    {
        $this->Id_user = $Id_user;

        return $this;
    }

    /**
     * Get the value of Nom_user
     */
    public function getNom_user()
    {
        return $this->Nom_user;
    }

    /**
     * Set the value of Nom_user
     */
    public function setNom_user($Nom_user): self
    {
        $this->Nom_user = $Nom_user;

        return $this;
    }

    /**
     * Get the value of Prenom_user
     */
    public function getPrenom_user()
    {
        return $this->Prenom_user;
    }

    /**
     * Set the value of Prenom_user
     */
    public function setPrenom_user($Prenom_user): self
    {
        $this->Prenom_user = $Prenom_user;

        return $this;
    }

    /**
     * Get the value of Email_user
     */
    public function getEmail_user()
    {
        return $this->Email_user;
    }

    /**
     * Set the value of Email_user
     */
    public function setEmail_user($Email_user): self
    {
        $this->Email_user = $Email_user;

        return $this;
    }

    /**
     * Get the value of Telephone_user
     */
    public function getTelephone_user()
    {
        return $this->Telephone_user;
    }

    /**
     * Set the value of Telephone_user
     */
    public function setTelephone_user($Telephone_user): self
    {
        $this->Telephone_user = $Telephone_user;

        return $this;
    }

    /**
     * Get the value of AdressePostale_user
     */
    public function getAdressePostale_user()
    {
        return $this->AdressePostale_user;
    }

    /**
     * Set the value of AdressePostale_user
     */
    public function setAdressePostale_user($AdressePostale_user): self
    {
        $this->AdressePostale_user = $AdressePostale_user;

        return $this;
    }

    /**
     * Get the value of MotDePasse_user
     */
    public function getMotDePasse_user()
    {
        return $this->MotDePasse_user;
    }

    /**
     * Set the value of MotDePasse_user
     */
    public function setMotDePasse_user($MotDePasse_user): self
    {
        $this->MotDePasse_user = $MotDePasse_user;

        return $this;
    }

    /**
     * Get the value of Role_user
     */
    public function getRole_user()
    {
        return $this->Role_user;
    }

    /**
     * Set the value of Role_user
     */
    public function setRole_user($Role_user = 0): self
    {
        $this->Role_user = $Role_user;

        return $this;
    }

    /**
     * Get the value of DateRGPD
     */
    public function getDateRGPD()
    {
        return $this->DateRGPD;
    }

    /**
     * Set the value of DateRGPD
     */
    public function setDateRGPD($DateRGPD): self
    {
        $this->DateRGPD = $DateRGPD;

        return $this;
    }
}
