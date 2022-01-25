<?php
class AdministracePojisteniKontroler extends Kontroler
{
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
        }
        $this->hlavicka = array('titulek' => '', 'klicova_slova' => '', 'popis' => '');

        $administrace = new Administrace();
        $pojisteni = $administrace->vratJednoPojisteni($parametry[1]);
        $this->data['nazev_pojisteni'] = $pojisteni['nazev_pojisteni'];
        $this->data['druh_auta'] = $pojisteni['druh_auta'];
        $this->data['cena_auta'] = $pojisteni['cena_auta'];
        $this->data['delka_pojisteni'] = $pojisteni['delka_pojisteni'];
        $this->data['mesicni_splatka'] = $pojisteni['mesicni_splatka'];
        $this->data['datum_vytvoreni'] = $pojisteni['datum_vytvoreni'];
        $this->data['typ_druh'] = $pojisteni['typ_druh'];
        $this->data['uzivatele_id'] = $pojisteni['ID'];
        $this->pohled = 'administrace-zmena-nastaveni-pojisteni';
        $this->data["parametr"] = $parametry[0]?? null;
        if($parametry[0] === 'upravit' && isset($_POST['upravit']))
        {
            $nazev_pojisteni = $_POST['nazev_pojisteni'];
            $druh_auta = $_POST['druh_auta'];
            $cena_auta = $_POST['cena_auta'];
            $delka_pojisteni = $_POST['delka_pojisteni'];
            $mesicni_splatka = $_POST['mesicni_splatka'];
            $datum_vytvoreni = $_POST['datum_vytvoreni'];
            $typ_druh = $_POST['typ_druh'];
            $administrace->upravPojisteni($nazev_pojisteni, $druh_auta, $cena_auta, $delka_pojisteni, $mesicni_splatka, $datum_vytvoreni, $typ_druh, $parametry[1]);
            $this->pridejZpravu('záznam byl upravený.');
            $this->presmeruj('Uvod-Administrace/vypis-pojisteni');
        }
        if($parametry[0] === 'smazat' && isset($_POST['smazat']))
        {
            $administrace->smazPojisteni($parametry[1]);
            $this->pridejZpravu('záznam byl smazaný.');
            $this->presmeruj('Uvod-Administrace/vypis-pojisteni');
        }
    }
}