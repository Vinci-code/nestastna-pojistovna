<?php
class EvidenceKontroler extends Kontroler
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
            $this->presmeruj('chyba');
        };

        $this->hlavicka = array('titulek' => 'Evidence pojistné události', 'klicova_slova' => 'evidence, pojistná událost, auto, havárie', 'popis' => 'evidence pojisteni auto');
        $this->pohled = 'evidence';
        
        $spravcePojisteni = new SpravcePojisteni();
        
        $seznamPojisteni = $spravcePojisteni->vratPojistneUdalosti($_SESSION['uzivatele_id']);
        $this->data['seznamPojisteni'] = $seznamPojisteni;
     }
}