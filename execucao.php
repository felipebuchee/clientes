<?php
require_once("modelo/Atacante.php");
require_once("modelo/Goleiro.php");
require_once("dao/JogadorDAO.php");

do {
    print "\n\n--- GERENCIAMENTO DE JOGADORES -------------\n";
    print "1 - Cadastrar Atacante ------------------\n";
    print "2 - Cadastrar Goleiro -------------------\n";
    print "3 - Listar Jogadores -------------------\n";
    print "4 - Buscar Jogador --------------------\n";
    print "5 - Excluir Jogador -------------------\n";
    print "0 - Sair ------------------------------\n";

    $opcao = readline("Informe a opção: ");

    switch ($opcao) {
        case 1:
            $jogador = new Atacante();
            $jogador->setNome(readline("Informe o nome:  "));
            $jogador->setIdade(readline("Informe a idade:  "));
            $jogador->setPosicao("Atacante");
            $jogador->setTime(readline("Informe o time:  "));
            $jogador->setGols(readline("Informe o número de gols:  "));

            $jogadorDAO = new JogadorDAO();
            $jogadorDAO->inserirJogador($jogador);
            print "Atacante cadastrado com sucesso!!\n\n";
            break;

        case 2:
            $jogador = new Goleiro();
            $jogador->setNome(readline("Informe o nome:  "));
            $jogador->setIdade(readline("Informe a idade:  "));
            $jogador->setPosicao("Goleiro");
            $jogador->setTime(readline("Informe o time:  "));
            $jogador->setDefesas(readline("Informe o número de defesas:  "));

            $jogadorDAO = new JogadorDAO();
            $jogadorDAO->inserirJogador($jogador);
            print "Goleiro cadastrado com sucesso!!\n\n";
            break;

        case 3:
            $jogadorDAO = new JogadorDAO();
            $jogadores = $jogadorDAO->listarJogadores();

            print("ID | NOME | IDADE | POSIÇÃO | TIME | GOLS | DEFESAS\n\n");
            foreach ($jogadores as $j) {
                printf(
                    "%d - %s | %d | %s | %s | %s | %s\n",
                    $j->getId(),
                    $j->getNome(),
                    $j->getIdade(),
                    $j->getPosicao(),
                    $j->getTime(),
                    method_exists($j, 'getGols') ? $j->getGols() : 'N/A',
                    method_exists($j, 'getDefesas') ? $j->getDefesas() : 'N/A'
                );
            }
            break;

        case 4:
            $id = readline("Informe o ID do jogador que deseja buscar: ");
            $jogadorDAO = new JogadorDAO();
            $jogador = $jogadorDAO->buscarPorId($id);

            if ($jogador !== null) {
                print "Jogador encontrado:\n";
                printf(
                    "%d - %s | %d | %s | %s | %s | %s\n",
                    $jogador->getId(),
                    $jogador->getNome(),
                    $jogador->getIdade(),
                    $jogador->getPosicao(),
                    $jogador->getTime(),
                    method_exists($jogador, 'getGols') ? $jogador->getGols() : 'N/A',
                    method_exists($jogador, 'getDefesas') ? $jogador->getDefesas() : 'N/A'
                );
            } else {
                print "Jogador não encontrado!\n";
            }
            break;

        case 5:
            $jogadorDAO = new JogadorDAO();
            $jogadores = $jogadorDAO->listarJogadores();

            print("ID | NOME | IDADE | POSIÇÃO | TIME | GOLS | DEFESAS\n");
            foreach ($jogadores as $j) {
                printf(
                    "%d - %s | %d | %s | %s | %s | %s\n",
                    $j->getId(),
                    $j->getNome(),
                    $j->getIdade(),
                    $j->getPosicao(),
                    $j->getTime(),
                    method_exists($j, 'getGols') ? $j->getGols() : 'N/A',
                    method_exists($j, 'getDefesas') ? $j->getDefesas() : 'N/A'
                );
            }

            $id = readline("Informe o ID do jogador que deseja excluir: ");
            $jogadorDAO->excluirJogador($id);
            print "Jogador excluído com sucesso!\n";
            break;

        case 0:
            print "Programa encerrado!\n";
            break;

        default:
            print "Opção inválida!\n";
            break;
    }
} while ($opcao != 0);
