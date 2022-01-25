<?php
class RegistrovatKontroler extends Kontroler
{
    public function zpracuj($parametry)
    {
        
        $this->hlavicka = array(
            'titulek' => 'Registrace',
            'klicova_slova' => 'přihlášení, registrace, formulář',
            'popis' => 'registrační formulář mého webu.'
        );
        $this->pohled = 'registrace';
        $this->data['zprava_info'] = $_SESSION['zprava_info']?? null ;       
        unset($_SESSION['zprava_info']);

        if(isset($_POST["registrovat"]))
        {
            $prezdivka = $_POST["prezdivka"];
            $jmeno = $_POST["jmeno"];
            $prijmeni = $_POST["prijmeni"];
            $heslo = $_POST["heslo"];
            $hesloZnovu = $_POST["hesloZnovu"];
            $email = $_POST["email"];

            $registraceSpravce = NEW Registrace($prezdivka, $jmeno, $prijmeni, $heslo, $hesloZnovu, $email);
            $registraceSpravce->registrujUzivatele();
            
            
            $this->pridejZpravu("Jsi úspěšně zaregistrován, nyní se můžeš přihlásit");
            $this->presmeruj('prihlaseni');
        }
    }
}