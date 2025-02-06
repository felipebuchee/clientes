<?php

abstract class Robo
{

    //Atributos
    protected int $id;
    protected string $nomeRobo;
    protected int $quantRodas;
    protected string $modalidade;
    protected string $premiacoes;

    abstract public function getTipo();
 
    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nomeRobo
     */
    public function getNomeRobo(): string
    {
        return $this->nomeRobo;
    }

    /**
     * Set the value of nomeRobo
     */
    public function setNomeRobo(string $nomeRobo): self
    {
        $this->nomeRobo = $nomeRobo;

        return $this;
    }

    /**
     * Get the value of quantRodas
     */
    public function getQuantRodas(): int
    {
        return $this->quantRodas;
    }

    /**
     * Set the value of quantRodas
     */
    public function setQuantRodas(int $quantRodas): self
    {
        $this->quantRodas = $quantRodas;

        return $this;
    }

    /**
     * Get the value of modalidade
     */
    public function getModalidade(): string
    {
        return $this->modalidade;
    }

    /**
     * Set the value of modalidade
     */
    public function setModalidade(string $modalidade): self
    {
        $this->modalidade = $modalidade;

        return $this;
    }

    /**
     * Get the value of premiacoes
     */
    public function getPremiacoes(): string
    {
        return $this->premiacoes;
    }

    /**
     * Set the value of premiacoes
     */
    public function setPremiacoes(string $premiacoes): self
    {
        $this->premiacoes = $premiacoes;

        return $this;
    }

    /**
     * Get the value of tipo
     */

}
