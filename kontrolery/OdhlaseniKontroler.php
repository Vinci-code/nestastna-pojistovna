<?php
class OdhlaseniKontroler extends Kontroler
{   
    
    
    public function zpracuj($parametry)
    {
        $this->hlavicka = array(
            'popis' => 'Odhlášení',
            'klicova_slova' => 'odhlasit',
            'titulek' => 'Odhlášení'
        );
        $this->pridejZpravu('úspěch');
        $this->pohled = 'odhlaseni';
        $this->odhlasUzivatele();
    }

    private function odhlasUzivatele()
    {
         
        if(isset($_SESSION["prezdivka"]) && isset($_SESSION["email"]))
        {   
            $_SESSION["email"] = null;
            $_SESSION["prezdivka"] = null;
            session_unset();
            session_destroy();
            header("Location: Odhlaseni");
            header("Connection: close");
            exit;
        }
          
    }
}