<?php

abstract class Jogador
{
    // Atributos
    protected int $id;
    protected string $nome;
    protected int $idade;
    protected string $posicao;
    protected string $time;

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
     * Get the value of nome
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * Get the value of idade
     */
    public function getIdade(): int
    {
        return $this->idade;
    }

    /**
     * Set the value of idade
     */
    public function setIdade(int $idade): self
    {
        $this->idade = $idade;
        return $this;
    }

    /**
     * Get the value of posicao
     */
    public function getPosicao(): string
    {
        return $this->posicao;
    }

    /**
     * Set the value of posicao
     */
    public function setPosicao(string $posicao): self
    {
        $this->posicao = $posicao;
        return $this;
    }

    /**
     * Get the value of time
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * Set the value of time
     */
    public function setTime(string $time): self
    {
        $this->time = $time;
        return $this;
    }
}