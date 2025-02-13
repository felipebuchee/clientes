<?php

require_once("Jogador.php");

class Goleiro extends Jogador
{
    // Atributos
    private int $defesas;

    public function getTipo()
    {
        return "Goleiro";
    }

    /**
     * Get the value of defesas
     */
    public function getDefesas(): int
    {
        return $this->defesas;
    }

    /**
     * Set the value of defesas
     */
    public function setDefesas(int $defesas): self
    {
        $this->defesas = $defesas;
        return $this;
    }
}
