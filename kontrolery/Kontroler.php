<?php
/**
 * Výchozí kontroler
 */
abstract class Kontroler
{

	/**
     * Pole, jehož indexy jsou poté viditelné v šabloně jako běžné proměnné
     */
    protected $data = array();

	/**
     * Název šablony bez přípony
     */
    protected $pohled = "";

	/**
     * Hlavička HTML stránky
     **/
	protected $hlavicka = array('titulek' => '', 'klicova_slova' => '', 'popis' => '');

    /**
     * rozbalí data pro šablonu a vyrenderuje pohled  
     **/
    public function vypisPohled()
    {
        if ($this->pohled)
        {
            extract($this->osetri($this->data));
            require("pohledy/" . $this->pohled . ".phtml");
        }
    }
	
	/**
     * Přesměruje na zadanou URL
     */
	public function presmeruj($url)
	{
		header("Location: /$url");
		header("Connection: close");
        exit;
	}

	/**
     * Hlavní metoda controlleru
     */
    abstract function zpracuj($parametry);

    /**
     * Metoda vrátí ošetřený výstup uživateli
     */
    private function osetri($x = null)
    {
        if (!isset($x))
            return null;
        elseif (is_string($x))
            return htmlspecialchars($x, ENT_QUOTES);
        elseif (is_array($x))
        {
            foreach($x as $k => $v)
            {
                $x[$k] = $this->osetri($v);
            }
            return $x;
        }
        else
            return $x;
    }
    

    protected function pridejZpravu($zprava)
    {
        if (isset($_SESSION['zpravy']))
            $_SESSION['zpravy'][] = $zprava;
        else
            $_SESSION['zpravy'] = array($zprava);
    }

    protected function vratZpravy()
    {
        if (isset($_SESSION['zpravy'])){
            $zpravy = $_SESSION['zpravy'];
            unset($_SESSION['zpravy']);
            return $zpravy;
        }
        else
            return array();
    }

}