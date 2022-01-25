<?php
class PojisteniKontroler extends Kontroler
{
    public function zpracuj($parametry)
    {
        try
        {
            Validator::overPrihlaseniUzivatele();
        }
        catch (ChybaUzivatele $chyba)
        {
            $this->pridejZpravu($chyba->getMessage());
            $this->presmeruj('prihlaseni');
        };

        $this->hlavicka = array('titulek' => '', 'klicova_slova' => '', 'popis' => '');

        $spravcePojisteni = new SpravcePojisteni();
        
        if (!empty($parametry[0])){
            $pojisteni = $spravcePojisteni->vratJednoPojisteni($parametry[0], $_SESSION['uzivatele_id']);

            if (!$pojisteni) $this->presmeruj('chyba');

            $this->data["nazevPojisteni"] = $pojisteni['nazev_pojisteni'];
            $this->data["delkaPojisteni"] = $pojisteni['delka_pojisteni'];
            $this->data["mesicniSplatka"] = $pojisteni['mesicni_splatka'];
            $this->data["datumVytvoreni"] = $pojisteni['datum_vytvoreni'];
            $this->data["druhAuta"]        = $pojisteni['druh_auta'];
            $this->pohled = 'pojisteni-detail';
            
        }
        else {
            $this->data["pojisteni"] = $spravcePojisteni->vratVsechnaPojisteni($_SESSION['uzivatele_id']);
            $this->pohled = 'pojisteni';
        }
    }

}