<?php

class UvodAdministraceKontroler extends Kontroler
{
    private $vypisUzivatele = 'vypis-uzivatelu';
    private $vypisPojisteni = 'vypis-pojisteni';
    private $vypisPojisteneUzivatele = 'vypis-pojistenych-uzivatelu';

    function zpracuj($parametry)
    {
        try
        {
            $validator = new Validator();
            $validator->overAdmina();
        }
        catch (ChybaUzivatele $chyba)
        {
            $this->pridejZpravu($chyba->getMessage());
            $this->presmeruj('chyba');
        };
        
        $this->hlavicka = array('titulek' => '', 'klicova_slova' => '', 'popis' => '');

        $this->pohled = 'uvod-administrace';
        $administrace = new Administrace();
        $pocetUzivatelu = $administrace->zjistiPocetUzivatelu();
        $pocetPojisteniAut = $administrace->zjistiPocetPojisteniAut();
        $pocetPojUdalosti = $administrace->zjistiPocetPojUdalosti();
        $MesicniSplatky = $administrace->zjistiMesicniSplatky();
        
        $this->data["mesicniSplatky"] = $MesicniSplatky;
        $this->data["pocetUzivatelu"] = $pocetUzivatelu;
        $this->data["pocetPojUdalosti"] = $pocetPojUdalosti;
        $this->data["pocetPojisteni"] = $pocetPojisteniAut;

        if(isset($parametry[0]))
        {  
            if($parametry[0] === $this->vypisUzivatele){
                
                $vypisUzivatele = $administrace->vypisUzivatele();
                
                if (!$vypisUzivatele) $this->presmeruj('chyba');

                $this->data["vypisUzivatele"] = $vypisUzivatele;
                $this->pohled = 'vypis-uzivatelu';

            }
            elseif ($parametry[0] === $this->vypisPojisteni)
            {
                $vypisPojisteni = $administrace->vypisPojisteni();
                if (!$vypisPojisteni) $this->presmeruj('chyba');
                $this->data["vypisPojisteni"] = $vypisPojisteni;
                $this->pohled = 'vypis-pojisteni';
            }
            elseif ($parametry[0] === $this->vypisPojisteneUzivatele)
            {
                $vypisPojistenychUzivatelu = $administrace->vratPojisteneUzivatele();
                if (!$vypisPojistenychUzivatelu) $this->presmeruj('chyba');
                $this->data["vypisPojistenychUzivatelu"] = $vypisPojistenychUzivatelu;
                $this->pohled = 'vypis-pojistenych-uzivatelu';
            }
        }
    }
}