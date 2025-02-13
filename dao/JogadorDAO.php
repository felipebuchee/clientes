<?php
require_once("modelo/Jogador.php");
require_once("modelo/Atacante.php");
require_once("modelo/Goleiro.php");
require_once("util/Conexao.php");

class JogadorDAO
{
    // Método para inserir um jogador
    public function inserirJogador(Jogador $jogador)
    {
        $sql = "INSERT INTO jogadores (nome, idade, posicao, time, gols, defesas, tipo)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $con = Conexao::getCon();
        $stm = $con->prepare($sql);
        
        if ($jogador instanceof Atacante) {
            $stm->execute([
                $jogador->getNome(),
                $jogador->getIdade(),
                $jogador->getPosicao(),
                $jogador->getTime(),
                $jogador->getGols(),
                null,
                $jogador->getTipo()
            ]);
        } elseif ($jogador instanceof Goleiro) {
            $stm->execute([
                $jogador->getNome(),
                $jogador->getIdade(),
                $jogador->getPosicao(),
                $jogador->getTime(),
                null,
                $jogador->getDefesas(),
                $jogador->getTipo()
            ]);
        }
    }

    // Método para listar jogadores
    public function listarJogadores()
    {
        $sql = "SELECT * FROM jogadores";
        $con = Conexao::getCon();
        $stm = $con->prepare($sql);
        $stm->execute();
        $registros = $stm->fetchAll();

        return $this->mapJogadores($registros);
    }

    private function mapJogadores(array $registros)
    {
        $jogadores = [];
        foreach ($registros as $reg) {
            if ($reg['tipo'] === 'A') {
                $jogador = new Atacante();
                $jogador->setGols($reg['gols']);
            } elseif ($reg['tipo'] === 'G') {
                $jogador = new Goleiro();
                $jogador->setDefesas($reg['defesas']);
            } else {
                continue;
            }

            $jogador->setId($reg['id']);
            $jogador->setNome($reg['nome']);
            $jogador->setIdade($reg['idade']);
            $jogador->setPosicao($reg['posicao']);
            $jogador->setTime($reg['time']);
            
            $jogadores[] = $jogador;
        }
        return $jogadores;
    }

    public function buscarPorId(int $id)
    {
        $sql = "SELECT * FROM jogadores WHERE id = ?";
        $con = Conexao::getCon();
        $stm = $con->prepare($sql);
        $stm->execute([$id]);
        $registro = $stm->fetch();

        if ($registro) {
            if ($registro['tipo'] === 'A') {
                $jogador = new Atacante();
                $jogador->setGols($registro['gols']);
            } elseif ($registro['tipo'] === 'G') {
                $jogador = new Goleiro();
                $jogador->setDefesas($registro['defesas']);
            } else {
                return null;
            }

            $jogador->setId($registro['id']);
            $jogador->setNome($registro['nome']);
            $jogador->setIdade($registro['idade']);
            $jogador->setPosicao($registro['posicao']);
            $jogador->setTime($registro['time']);

            return $jogador;
        }
        return null;
    }

    public function excluirJogador($id)
    {
        $sql = "DELETE FROM jogadores WHERE id = ?";
        $con = Conexao::getCon();
        $stm = $con->prepare($sql);
        $stm->execute([$id]);
    }
}
