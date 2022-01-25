<?php
class UvodKontroler extends Kontroler
{
    public function zpracuj($parametry)
    {
    
    $this->hlavicka['titulek'] = 'Úvod';
    $this->hlavicka['popis'] = 'uvodni_stranka';
    $this->hlavicka['klicova_slova'] = 'uvodni_stranka';
    
    $this->pohled = 'uvod';
    }
}