<?php

class Rechteck{

    // Attribute / Eigenschaften
    private $laenge;
    private $breite;

    // Konstruktor
    public function __construct(int $laenge, int $breite){
     /*   if($breite == 0 || $laenge == 0) {
            echo "Error: Die Werte müssen größer als 0 sein.<br><br>";
            return;
        } */
        $this->setLaenge($laenge);
        $this->setBreite($breite);
    }

    // Setter / Getter

    public function setLaenge(int $laenge){
        
        if($laenge == 0) {
            echo "Error: Die Länge muss größer als 0 sein.<br><br>";
            return;
        }
        
    $this->laenge = $laenge;
    }

    // Rückgabetyp mit : int angeben

    public function getLaenge() : int {
    return $this->laenge;
    }

    public function setBreite(int $breite) : void{
        if($breite == 0) {
            echo "Error: Die Breite muss größer als 0 sein.<br><br>";
            return;
        }
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
