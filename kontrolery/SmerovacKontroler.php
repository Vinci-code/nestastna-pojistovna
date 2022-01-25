<?php
class SmerovacKontroler extends Kontroler
{
    protected $kontroler;

    private function pomlckyDoVelbloudiNotace($text)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $text)));
    }
/**
 * 
 */
    private function parsujURL($url)
    {
        $naparsovanaURL = parse_url($url);
        $rozdelenaURL = explode("/", trim(ltrim($naparsovanaURL["path"], "/")));
        return $rozdelenaURL;
    }
    /**
     * 
     */
    public function zpracuj($parametry)
    {   
        $naparsovanaURL = $this->parsujURL($parametry[0]);

        if (empty($naparsovanaURL[0]))$this->presmeruj('uvod/');
            $tridaKontroleru = $this->pomlckyDoVelbloudiNotace(array_shift($naparsovanaURL)) . 'Kontroler';

            if (file_exists('kontrolery/' . $tridaKontroleru . '.php'))
            {
                
                $this->kontroler = new $tridaKontroleru;
                $this->kontroler->zpracuj($naparsovanaURL);
                $this->data['titulek'] = $this->kontroler->hlavicka['titulek'];
                $this->data['popis'] = $this->kontroler->hlavicka['popis'];
                $this->data['klicova_slova'] = $this->kontroler->hlavicka['klicova_slova'];
                $this->pohled = 'rozlozeni';
                $this->data['zpravy'] = $this->vratZpravy();
            }
        else $this->presmeruj('chyba');
    }
}