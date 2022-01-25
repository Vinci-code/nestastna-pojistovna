<?php

/**
 * KontaktKontroler
 */
class KontaktKontroler extends Kontroler
{
    /**
     * Hlavní metoda kontroleru
     * odešle email pokud je správně vyplněný antispam a nastaví zprávu, že vše proběhlo správně nebo vyhodí vyjímku při neúspěchu.
     */
    public function zpracuj($parametry)
    {

        $this->hlavicka = array(
            'titulek' => 'Kontaktní formulář',
            'klicova_slova' => 'kontakt, email, formulář',
            'popis' => 'Kontaktní formulář'
        );
        $this->pohled = 'kontaktniFormular';

        if ($_POST)
        {
            try
            {
                $odesilacEmailu = new Mailer();
                $odesilacEmailu->odesliSAntispamem($_POST['rok'], "vvincent848@gmail.com", "Email z webu", $_POST['zprava'], $_POST['email']);
                $this->pridejZpravu('Email byl úspěšně odeslán.');
                $this->presmeruj('kontakt');
            }
            catch (ChybaUzivatele $chyba)
            {
                $this->pridejZpravu($chyba->getMessage());
            }
            
        }    
    }
}