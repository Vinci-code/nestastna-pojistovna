<?php
class Administrace
{

    public function vypisUzivatele()
    {
        return Db::dotazVsechny("SELECT * FROM `uzivatele` ORDER BY `uzivatele_id` ASC
        ;");
        
    }
    public function vratJednohoUzivatele($id)
    {
        return Db::dotazJeden("SELECT * FROM `uzivatele` WHERE `uzivatele_id` = ?;", array($id));
        
    }
    public function upravUzivatele($prezdivka, $jmeno , $prijmeni , $email, $id)
    {
        return Db::dotazJeden("UPDATE `uzivatele` SET `prezdivka` = ?,`jmeno` = ?, `prijmeni` = ?, `email` = ? WHERE `uzivatele_id` = ?;", array($prezdivka, $jmeno, $prijmeni, $email, $id));
    }
    public function smazUzivatele($id)
    {
        return Db::dotaz("DELETE FROM `uzivatele` WHERE  `uzivatele_id` = ?;", array($id));
    }
    ////////////////////////////////////////////////////////////////////
    public function vypisPojisteni()
    {
        return Db::dotazVsechny("SELECT * FROM `pojisteni-aut` ORDER BY `pojisteni-aut`.`ID` ASC
        ;");
    }

    public function vratJednoPojisteni($id)
    {
        return Db::dotazJeden("SELECT * FROM `pojisteni-aut` WHERE `ID` = ?;", array($id));
    }

    public function upravPojisteni($nazev_pojisteni, $druh_auta, $cena_auta, $delka_pojisteni, $mesicni_splatka, $datum_vytvoreni, $typ_druh, $id)
    {
        return Db::dotazJeden("UPDATE `pojisteni-aut` SET `nazev_pojisteni` = ?, `druh_auta` = ?, `cena_auta` = ?, `delka_pojisteni` = ?, `mesicni_splatka` = ?, `datum_vytvoreni` = ?, `typ_druh` = ? WHERE `ID` = ?;", array($nazev_pojisteni, $druh_auta, $cena_auta, $delka_pojisteni, $mesicni_splatka, $datum_vytvoreni, $typ_druh, $id));
    }

    public function smazPojisteni($id)
    {
        return Db::dotaz("DELETE FROM `pojisteni-aut` WHERE  `ID` = ?;", array($id));
    }

    public function zjistiPocetUzivatelu()
    {
        return Db::dotaz("SELECT `uzivatele_id` FROM `uzivatele` ORDER BY `uzivatele_id` ASC
        ;");
    }

    public function zjistiPocetPojisteniAut()
    {
        return Db::dotaz("SELECT `ID` FROM `pojisteni-aut` ORDER BY `ID`;");
    }

    public function zjistiPocetPojUdalosti()
    {
        return Db::dotaz("SELECT `ID` FROM `pojistne_udalosti` ORDER BY `ID`;");
    }

    public function zjistiMesicniSplatky()
    {
        $result = null;
        $mesicniSplatky = Db::dotazVsechny("SELECT `mesicni_splatka` FROM `pojisteni-aut` ORDER BY `mesicni_splatka`;");
       
        foreach ($mesicniSplatky as $key) {            
            $result .= $key['mesicni_splatka'] ." " ;
        };
        $result=array_sum(explode(" ", $result));
        return $result;
    }
    public function vratPojisteneUzivatele()
    {
        $result = Db::dotazVsechny("SELECT * FROM `pojisteni-aut` JOIN `uzivatele` ON `pojisteni-aut`.`uzivatele_id` = uzivatele.`uzivatele_id` ORDER BY `jmeno`");
        return $result;
    }

}