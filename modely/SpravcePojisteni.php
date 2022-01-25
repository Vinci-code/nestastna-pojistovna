<?php

/**
 * třída, která obsahuje metody pro práci s pojištěním nebo pojistnou událostí.
 */
class SpravcePojisteni
{
    /**
     * Vrátí jedno pojištění z databáze podle jeho URL
     */
    public function vratJednoPojisteni($url, $uzivatele_id)
    {
        return Db::dotazJeden('
             SELECT * FROM `pojisteni-aut`
             WHERE `nazev_pojisteni` = ? AND `uzivatele_id` = ?
         ', array($url, $uzivatele_id));
    }

    /**
     * Vrátí seznam pojištění v databázi
     */
    public function vratVsechnaPojisteni($uzivatele_id)
    {
        return Db::dotazVsechny('
             SELECT `ID`, `nazev_pojisteni`, `druh_auta`, `cena_auta`, `delka_pojisteni`, `mesicni_splatka`, `datum_vytvoreni`, `typ_druh`, `obrazek`
             FROM `pojisteni-aut` WHERE `uzivatele_id` = ? ORDER BY `nazev_pojisteni` ASC
         ', array($uzivatele_id));
    }

    /**
     * Vytvoří nové pojištění
     */
    public function vytvorNovePojisteni($uzivateleId, $nazevPojisteni, $druhAuta, $cenaAuta, $delkaPojisteni, $mesicniSplatka, $typDruh, $datumVytvoreni, $druhAutaText)
    {
        $result = Db::dotazJeden("INSERT INTO `pojisteni-aut` (uzivatele_id, nazev_pojisteni, druh_auta, cena_auta, delka_pojisteni, mesicni_splatka, typ_druh, datum_vytvoreni, obrazek) VALUES (?,?,?,?,?,?,?,?,?)", array($uzivateleId, $nazevPojisteni, $druhAuta, $cenaAuta, $delkaPojisteni, $mesicniSplatka, $typDruh, $datumVytvoreni, $druhAutaText));
        return $result;
    }

    /**
     * Vrátí seznam všech pojistných událostí v databázi podle id uzivatele
     */
    public function vratPojistneUdalosti($id)
    {
        return Db::dotazVsechny("SELECT * FROM `pojistne_udalosti` WHERE `uzivatel_id`= ?;", array($id));
    }

    /**
     * Vytvoří novou pojistnou událost
     * @param int $uzivatel_id uživatele ID
     * @param string $typ_udalosti výběr události, odcizení nebo krádež
     * @param string $obsah popis jak došlo k pojistné události
     * @param string $datum_vytvoreni datuv vytvoření pojistné události
     * @return void
     */
    public function vytvorNovouPojistnouUdalost($uzivatel_id, $typ_udalosti, $obsah, $datum_vytvoreni)
    {
        $result = Db::dotazJeden("INSERT INTO `pojistne_udalosti` (`uzivatel_id`, `typ_udalosti`, `obsah`, `datum_vytvoreni`) VALUES (?,?,?,?);", array($uzivatel_id, $typ_udalosti, $obsah, $datum_vytvoreni));
        return $result;
    }

    /**
     * vrátí číslo-počet poijištění v databázi
     */
    public function vratPocetPojisteni($id)
    {
        return Db::dotaz("SELECT COUNT(DISTINCT `ID`) FROM `pojisteni-aut` WHERE `uzivatele_id` = ?;", array($id));
    }

    /**
     * Ověří druh automobilu zda je osobní, nákladní nebo užitkový.
     */
    public function overDruhAuta($druhAuta)
    {
        if ($druhAuta === 'osobní') $result = 'osobni';
        elseif ($druhAuta === 'nákladní') $result = 'nakladni';
        else $result = 'uzitkovy';
        return $result;
    }

    /**
     * Ověří zda je typ poj. události nehoda nebo odcizení.
     */
    public function overTypUdalosti($TypUdalosti)
    {
        if ($TypUdalosti === 'odcizeni') $result = 'odcizeni';
        else $result = 'nehoda';
        return $result;
    }
}
