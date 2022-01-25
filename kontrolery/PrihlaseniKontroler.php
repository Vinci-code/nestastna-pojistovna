<?php
class PrihlaseniKontroler extends Kontroler
{
    public function zpracuj($parametry)
    {
        $this->hlavicka = array(
            'titulek' => 'Přihlášení',
            'klicova_slova' => 'přihlášení, registrace, formulář',
            'popis' => 'formulář k přihlášení.'
        );
        
        $this->pohled = 'prihlaseni';
        $this->data['zprava_info'] = $_SESSION['zprava_info']?? null ;       
        unset($_SESSION['zprava_info']);

        if(isset($_POST["prihlasit"]))
        {
            $prezdivka = $_POST["prezdivka"];
            $heslo = $_POST["heslo"];
            $email = $_POST["email"];
            $this->data['prezdivka'] = $prezdivka ? $prezdivka : "";
            $this->data['email'] = $email ? $email : ""; 
            $uzivatel = new Prihlaseni($prezdivka, $heslo, $email);
       
            $uzivatel->prihlasUzivatele();
            $this->pridejZpravu("Jsi úspěšně přihlášený" .$_SESSION['zprava_info']);
            
            

            $this->presmeruj('uvod');       
        }
    }
}