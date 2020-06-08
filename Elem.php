<?php


class Elem {

    private $ev;
    private $elem;
    private $vegyjel;
    private $rendszam;
    private $felfedezo;
    
    function __construct($ev, $elem, $vegyjel, $rendszam, $felfedezo) {
        $this->ev = $ev;
        $this->elem = $elem;
        $this->vegyjel = $vegyjel;
        $this->rendszam = $rendszam;
        $this->felfedezo = $felfedezo;
    }
    function getEv() {
        return $this->ev;
    }

    function getElem() {
        return $this->elem;
    }

    function getVegyjel() {
        return $this->vegyjel;
    }

    function getRndszam() {
        return $this->rendszam;
    }

    function getFelfedezo() {
        return $this->felfedezo;
    }

    function setEv($ev): void {
        $this->ev = $ev;
    }

    function setElem($elem): void {
        $this->elem = $elem;
    }

    function setVegyjel($vegyjel): void {
        $this->vegyjel = $vegyjel;
    }

    function setRndszam($rendszam): void {
        $this->rendszam = $rendszam;
    }

    function setFelfedezo($felfedezo): void {
        $this->felfedezo = $felfedezo;
    }


    
}
