<?php
class SpravceUzivatelu extends Validator
{
    /**
     * Volzi data do tabulky `uzivatele` v Db
     */
    protected function vlozUzivatele($prezdivka, $jmeno, $prijmeni, $heslo, $email)
    {
        $hesloHash = password_hash($heslo, PASSWORD_DEFAULT);
        $result = null;
        $result = Db::dotazJeden("INSERT INTO `uzivatele`(prezdivka,jmeno, prijmeni, heslo, email) VALUES (?, ?, ?, ?, ?);", array($prezdivka, $jmeno, $prijmeni, $hesloHash, $email));

        if($result)
        {
            $result = true;
        }
        else
        {
            $result = false;
        }
        return $result;
    }

    protected function vratUzivatele($prezdivka, $email)
    {
        $result = Db::dotazJeden('SELECT * FROM `uzivatele` WHERE  `prezdivka` = ? AND `email` = ?;', array($prezdivka, $email));
        if($result)
        {
            return $result;
        }
        else
        {
            throw new ChybaUzivatele('prezdivka nebo emailová adresa  neexistuje!');
        }
        
    }
    protected function existujeUzivatel()
    {
       
        
        if($this->vratUzivatele($this->prezdivka, $this->email))
        {
            throw new ChybaUzivatele('uživatel s tímto mailem nebo přezdívkou již existuje.');
        }
        else
        {
            return true;
        }
    }
    protected function vyberUzivatelePodleId($id)
    {
        return Db::dotazJeden("SELECT `jmeno`, `prijmeni`, `email` FROM `uzivatele` WHERE uzivatele. uzivatele_id = ?;", array($id));
    }
    
    protected function nastavZmenyUzivatele($jmeno, $prijmeni, $email, $id)
    {
        return Db::dotazJeden("UPDATE `uzivatele` SET `jmeno` = ?, `prijmeni` = ?, `email` = ? WHERE `uzivatele_id` = ?;", array($jmeno, $prijmeni, $email, $id));
    }

    protected function emptyInputReg()
    {
        if(empty($this->prezdivka) || empty($this->heslo) || empty($this->hesloZnovu) || empty($this->email))
        {
            throw new ChybaUzivatele('Musíš vyplnit všechna pole.');
        }
        else
        {
            return true;
        }
    }

    protected function emptyInputLog()
    {
        if(empty($this->prezdivka) || empty($this->heslo) || empty($this->email))
        {
            throw new ChybaUzivatele('Musíš vyplnit všechna pole.');
        }
        else
        {
            return true;
        }
    }
    
    protected function validniEmail()
    {
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            throw new ChybaUzivatele('Chybně vyplněný email.');
        }
        else
        {
            return true;
        }
    }

    protected function porovnejHesla()
    {
        if($this->hesloZnovu !== $this->heslo)
        {
            throw new ChybaUzivatele('zadaná hesla nesouhlasí.');
        }
        else
        {
            return true;
        }
    }

    protected function overHeslo($heslo, $hesloZDb)
    {
        $result = password_verify($heslo, $hesloZDb);
        if(!$result)
        {
            throw new ChybaUzivatele('zadané heslo nesouhlasí.');
        }
        else
        {
            return true;
        }; 
    }
}