<?php
/**
 * Mailer Reprezentuje odesílání emailu
 * @author Lukáš Vincent Doležal
 */
class Mailer
{    
    /**
     * odesli-metoda na odeslání emailu
     *
     * @param  string $komu email webamasterovi
     * @param  string $predmet
     * @param  string $zprava text poslaný v emailu
     * @param  string $od emailová adresa odesílatele
     * @return void odeslaný email pokud je vše ok
     * @throws ChybaUzivatele pokud se nepodaří odeslat email
     */
    private function odesli($komu, $predmet, $zprava, $od) : void
    {
        $hlavicka = "From: " . $od;
        $hlavicka .= "\nMIME-Version: 1.0\n";
        $hlavicka .= "Content-Type: text/html; charset=\"utf-8\"\n";
        if (!mb_send_mail($komu, $predmet, $zprava, $hlavicka))
            throw new ChybaUzivatele('Email se nepodařilo odeslat.');
    }
    
    /**
     * metoda odešle email pouze s dobře vyplněným antispamem
     *
     * @param  string $rok aktuální rok
     * @param  string $komu email webmasterovi
     * @param  string $predmet
     * @param  string $zprava obsah emailu text poslaný uživatelem
     * @param  string $od email odesílatele
     * @return void úspěšně odešle email
     * @throws ChybaUzivatele pokud je špatně vyplněný antispam
     */
    public function odesliSAntispamem($rok, $komu, $predmet, $zprava, $od)
    {
        if ($rok != date("Y"))
            throw new ChybaUzivatele('Chybně vyplněný antispam.');
        $this->odesli($komu, $predmet, $zprava, $od);        
    }
}