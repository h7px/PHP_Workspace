<?php

class Rechteck{

    // Attribute / Eigenschaften
    private $laenge;
    private $breite;

    // Konstruktor
    public function __construct(int $laenge, int $breite){
        $this->setLaenge($laenge);
        $this->setBreite($breite);
    }

    // Setter / Getter

    public function setLaenge(int $laenge){
    $this->laenge = $laenge;
    }

    // Rückgabetyp mit : int angeben

    public function getLaenge() : int {
    return $this->laenge;
    }

    public function setBreite(int $breite) : void{
    $this->breite = $breite;
    }
    
    public function getBreite() : int {
    return $this->breite;
    }

    public function berechneFlaeche(){
    return $this->laenge * $this->breite;
    }

    public function berechneUmfang(){
    return $this->laenge * 2 + $this->breite * 2;
    }

}

?>
