<?php

require_once("Jogador.php");

class Atacante extends Jogador
{
    // Atributos
    private int $gols;

    public function getTipo()
    {
        return "Atacante";
    }

    /**
     * Get the value of gols
     */
    public function getGols(): int
    {
        return $this->gols;
    }

    /**
     * Set the value of gols
     */
    public function setGols(int $gols): self
    {
        $this->gols = $gols;
        return $this;
    }
}
