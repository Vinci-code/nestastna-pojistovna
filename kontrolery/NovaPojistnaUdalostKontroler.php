<?php
class NovaPojistnaUdalostKontroler extends Kontroler
{
    function zpracuj($parametry)
    {
        try
        {
            Validator::overPrihlaseniUzivatele();    
        }
        catch (ChybaUzivatele $chyba)
        {
            $this->pridejZpravu($chyba->getMessage());
            $this->presmeruj('chyba');
        };
        $this->pohled = 'nova-pojistna-udalost';
        $spravcePojisteni = new SpravcePojisteni();

        
        $pojisteni = $spravcePojisteni->vratVsechnaPojisteni($_SESSION['uzivatele_id']);

        $this->data['nazvyPojisteni'] = $pojisteni;

        if(isset($_POST["odeslat"])){
            
            $typ = $_POST["typ"];
            $popis = $_POST["popis"];
            $datum = new DateTime();
            $datum = $datum->format("j.n.Y");
            $spravcePojisteni->vytvorNovouPojistnouUdalost($_SESSION["uzivatele_id"], $typ, $popis, $datum);
            $this->pridejZpravu('nová pojistná událost je vytvořena');
        }
        
    }
    
}