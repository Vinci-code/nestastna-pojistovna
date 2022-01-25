<?php
class AdministraceUzivateluKontroler extends Kontroler
{
    public function zpracuj($parametry)
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
        }
        $this->hlavicka = array('titulek' => '', 'klicova_slova' => '', 'popis' => '');
        
        $administrace = new Administrace();
        $uzivatel = $administrace->vratJednohoUzivatele($parametry[1]);
        $this->data['prezdivka'] = $uzivatel['prezdivka'];
        $this->data['jmeno'] = $uzivatel['jmeno'];
        $this->data['prijmeni'] = $uzivatel['prijmeni'];
        $this->data['email'] = $uzivatel['email'];
        $this->pohled = 'administrace-zmena-nastaveni';
        $this->data["parametr"] = $parametry[0]?? null;
        if($parametry[0] === 'upravit' && isset($_POST['upravit']))
        {
            $prezdivka = $_POST['prezdivka'];
            $jmeno = $_POST['jmeno'];
            $prijmeni = $_POST['prijmeni'];
            $email = $_POST['email'];
            $administrace->upravUzivatele($prezdivka, $jmeno, $prijmeni, $email, $parametry[1]);
            $this->pridejZpravu('záznam byl upravený.');
            $this->presmeruj('Uvod-Administrace/vypis-uzivatelu');
        }
        if($parametry[0] === 'smazat' && isset($_POST['smazat']))
        {
            $administrace->smazUzivatele($parametry[1]);
            $this->pridejZpravu('záznam byl smazaný.');
            $this->presmeruj('Uvod-Administrace/vypis-uzivatelu');
        }
    }
}