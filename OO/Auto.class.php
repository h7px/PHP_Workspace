<?php

class Auto{

    private $geschwindigkeit;

    public function __construct($geschwindigkeit = 0){
        $this->geschwindigkeit = $geschwindigkeit;
    }

    public function setGeschwindigkeit(int $geschwindigkeit){
        $this->geschwindigkeit = $geschwindigkeit;
    }

    public function getGeschwindigkeit() : int{
        return $this->geschwindigkeit;
    }

    public function beschleunigen(){
        $this->geschwindigkeit+= 10;
    }

    public function bremsen(){
        $this->geschwindigkeit = max(0, $this->geschwindigkeit - 10);
    }

}
?>