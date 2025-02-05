<?php

require_once("Robo.php");

class RoboLego extends Robo
{

    //Atributos
    private string $tipoSistema;


    /**
     * Get the value of tipoSistema
     */
    public function getTipoSistema(): string
    {
        return $this->tipoSistema;
    }

    /**
     * Set the value of tipoSistema
     */
    public function setTipoSistema(string $tipoSistema): self
    {
        $this->tipoSistema = $tipoSistema;

        return $this;
    }
}
