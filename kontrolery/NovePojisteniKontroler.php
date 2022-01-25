<?php
class NovePojisteniKontroler extends Kontroler
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
        $this->pohled = 'nove-pojisteni';

        $this->hlavicka = array('titulek' => 'nové pojištění', 'klicova_slova' => '', 'popis' => '');

        $this->data['zprava_info'] = $_SESSION['zprava_info']?? null ;       
        unset($_SESSION['zprava_info']);
        if(isset($_POST["vytvorit"]))
        {
            try {
                Validator::emptyInputPoj($_POST['cena-auta'], $_POST['typ-druh']);
            }
            catch (ChybaUzivatele $chyba)
            {
                $_SESSION['zprava_info'] = $chyba->getMessage();
                Validator::presmerujNa('nove-pojisteni');
            };
            $Pojisteni = new SpravcePojisteni();
            $uzivateleId = $_SESSION['uzivatele_id'];
                        
            $druhAuta = $_POST['druh-auta'];

            $druhAutaText = $Pojisteni->overDruhAuta($druhAuta);

            $cenaAuta = $_POST['cena-auta'];
            $delkaPojisteni = $_POST['delka-pojisteni'];
            $mesicniSplatka = round($cenaAuta / 250);
            $mesicniSplatka = ($mesicniSplatka > 200) ? $mesicniSplatka : 200;
            $nazevPojisteni = "Poj-Auto-$uzivateleId-" .rand(500,1000);
            
            
            $typDruh = $_POST['typ-druh'];
            $datumVytvoreni = new DateTime();
            $datumVytvoreni = $datumVytvoreni->format("j.n.Y");
            
            $this->pohled = 'pripravene-pojisteni';
            
            $this->data["cenaAuta"] = $cenaAuta;
            $this->data["druhAuta"] = $druhAutaText;
            $this->data["mesicniSplatka"] = $mesicniSplatka;
            $this->data["nazevPojisteni"] = $nazevPojisteni;

            $Pojisteni->vytvorNovePojisteni($uzivateleId, $nazevPojisteni, $druhAuta, $cenaAuta, $delkaPojisteni, $mesicniSplatka, $typDruh, $datumVytvoreni, $druhAutaText);
            $this->pridejZpravu('nové pojištění je vytvořené');
        }
    }
}