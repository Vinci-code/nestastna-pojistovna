<?php
class NastaveniProfiluKontroler extends Kontroler
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
        }
        $this->hlavicka = array('titulek' => '', 'klicova_slova' => '', 'popis' => '');
        
        $this->data['hlavicka'] = array('popis' => 'nastavení profilu');
        $this->pohled = 'nastaveni-uzivatele';
        $spravceNastaveni = new NastaveniProfilu();
        
        $id = $_SESSION['uzivatele_id'];

        try {
            $uzivatel = $spravceNastaveni->pripravUzivatelePohled($id);    
        }catch (ChybaUzivatele $chyba)
        {
            $this->pridejZpravu($chyba->getMessage());
        }
        
        
        $jmeno = $uzivatel['jmeno'];
        $prijmeni = $uzivatel['prijmeni'];
        $email = $uzivatel['email'];

        $this->data['jmeno']=$jmeno;
        $this->data['prijmeni']=$prijmeni;
        $this->data['email']=$email;
        

        if(isset($_POST['zmenaNastaveni']))
        {
            $jmeno = $_POST['jmeno'];
            $prijmeni = $_POST['prijmeni'];
            $email = $_POST['email'];
            $spravceNastaveni->nastavNoveHodnoty($jmeno, $prijmeni, $email, $id);
            $this->pridejZpravu('změny jsou provedeny');
            $this->presmeruj('pojisteni');
        }
    }
}