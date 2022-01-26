<?php
class Registrace extends SpravceUzivatelu
{
    protected $prezdivka;
    protected $jmeno;
    protected $prijmeni;
    protected $heslo;
    protected $hesloZnovu;
    protected $email;

    public function __construct($prezdivka, $jmeno, $prijmeni, $heslo, $hesloZnovu, $email)
    {
        $this->prezdivka=$prezdivka;
        $this->jmeno=$jmeno;
        $this->prijmeni=$prijmeni;
        $this->heslo=$heslo;
        $this->hesloZnovu=$hesloZnovu;
        $this->email=$email;
    }
    
    public function registrujUzivatele()
    {
        try
        {
            $this->emptyInputReg();
            // $this->existujeUzivatel();
            $this->validniEmail();
            $this->porovnejHesla();
        }
        catch (ChybaUzivatele $chyba)
        {
            $_SESSION['zprava_info'] = $chyba->getMessage();
            Validator::presmerujNa('registrovat');
        };
        parent::vlozUzivatele($this->prezdivka,$this->jmeno,$this->prijmeni, $this->heslo, $this->email);       
    }
}