<?php

require_once("Robo.php");

class RoboArduino extends Robo
{
    //Atributos
    private string $tipoPlaca;

    public function getTipo(){
        return "Arduino";
    }

    /**
     * Get the value of tipoPlaca
     */
    public function getTipoPlaca(): string
    {
        return $this->tipoPlaca;
    }

    /**
     * Set the value of tipoPlaca
     */
    public function setTipoPlaca(string $tipoPlaca): self
    {
        $this->tipoPlaca = $tipoPlaca;

        return $this;
    }
}
