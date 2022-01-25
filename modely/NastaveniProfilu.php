<?php
class NastaveniProfilu extends SpravceUzivatelu
{
    public function pripravUzivatelePohled($id)
    {
        $result = $this->vyberUzivatelePodleId($id);

        if(!$result) throw new ChybaUzivatele("nejde najít podle Id");
        
        return $result;
    }

    public function nastavNoveHodnoty($jmeno, $prijmeni, $email, $id)
    {
        $result = $this->nastavZmenyUzivatele($jmeno, $prijmeni, $email, $id);
        return $result;
    }
}