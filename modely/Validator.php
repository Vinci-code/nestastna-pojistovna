<?php
class Validator
{
    private $admin = 1;
    private $jmeno = "Vincent";
    private $email = "vvincent848@gmail.com";
    

    public function overAdmina()
    {
        if($_SESSION["prezdivka"] === $this->jmeno && $_SESSION["email"] === $this->email && $_SESSION['admin1984'] === $this->admin) return true;
        else throw new ChybaUzivatele("NEjsi přihlášen jako ADMINISTRÁTOR WEBU!");
        
    }
    public static function overPrihlaseniUzivatele()
    {
        if(isset($_SESSION["prezdivka"]) && isset($_SESSION["email"])) return true; 
        else throw new ChybaUzivatele("nejsi přihlášený");
    }
    public static function presmerujNa($url)
    {

        header("Location: $url");
        header("Connection: close");
        exit; 
    }
    
    

    public static function emptyInputPoj($cenaAuta, $obsah)
    {
        if(empty($cenaAuta) || empty($obsah))
        {
            throw new ChybaUzivatele('Musíš vyplnit všechna pole.');
        }
        else
        {
            return true;
        }
    }
}