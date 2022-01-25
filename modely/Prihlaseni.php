<?php
class Prihlaseni extends SpravceUzivatelu
{
    protected $prezdivka;
    protected $heslo;
    protected $email;
    protected $id;
    
    public function __construct($prezdivka, $heslo, $email)
    {
        $this->prezdivka = $prezdivka;
        $this->heslo = $heslo;
        $this->email = $email;
    }

    public function prihlasUzivatele()
    {
        try
        {
            $this->emptyInputLog();
            $this->validniEmail();
            $uzivatel = $this->vratUzivatele($this->prezdivka, $this->email);
            $overeneheslo = $this->overHeslo($this->heslo, $uzivatel['heslo']);
        }
        catch (ChybaUzivatele $chyba)
        {
            $_SESSION['zprava_info'] = $chyba->getMessage();
            Validator::presmerujNa('prihlaseni');
        };
        $this->id = $uzivatel['uzivatele_id'];

        if($overeneheslo && $uzivatel['email'] == $this->email && $uzivatel['prezdivka'] == $this->prezdivka)
        {
            $_SESSION["uzivatele_id"] = $this->id;
            $_SESSION["prezdivka"] = $this->prezdivka;
            $_SESSION["email"] = $this->email;

            if($uzivatel['admin'] === 0)
            {
                $_SESSION['zprava_info'] = '..jako uživatel';
            }
            elseif($uzivatel['admin'] === 1)
            {
                if ($uzivatel['admin'] === 1) {$_SESSION["admin1984"] = $this->id;};
                $_SESSION['zprava_info'] = '..jako admin';
            }
        }
    }
}