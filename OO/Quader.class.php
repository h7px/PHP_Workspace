<?php

// Subklasse Quader: Sie erbt alle Attribute u. Methoden der Superklasse Rechteck

class Quader extends Rechteck{

    // Attribute / Eigenschaften
    private $hoehe;

    // Konstruktor
    public function __construct(int $hoehe, int $breite, int $laenge){
       /* if($hoehe == 0 || $breite == 0 || $laenge == 0) {
            echo "Error: Die Werte müssen größer als 0 sein.<br><br>";
            return;
        } */
        parent::__construct($laenge, $breite);
        $this->setHoehe($hoehe);
    }

    // Setter / Getter

    public function setHoehe(int $hoehe){
        if($hoehe == 0) {
            echo "Error: Die Höhe muss größer als 0 sein.<br><br>";
            return;
        }
        $this->hoehe = $hoehe;
    }

    // Rückgabetyp mit : int angeben

    public function getHoehe() : int {
        return $this->hoehe;
    }

    public function berechneVolumen(){
        return $this->berechneFlaeche() * $this->hoehe;
    }

    public function berechneOberflaeche(){
        return 2 * $this->getLaenge() * $this->getBreite() + 2 * $this->getLaenge() * $this->hoehe + 2 * $this->getBreite() * $this->hoehe;
    }

}

?>
