<?php
require_once("modelo/RoboArduino.php");
require_once("modelo/RoboLego.php");
require_once("dao/RoboticaDAO.php");

//Teste conexao
/*require_once("util/Conexao.php");
$con = Conexao::getCon();
print_r($con);*/

do {

    print "\n\n--- CADASTRO ROBÔS ------------\n";
    print "1 - Cadastrar Robô Lego --------\n";
    print "2 - Cadastrar Robô Arduino --------\n";
    print "3 - Listar Robôs --------------\n";
    print "4 - Buscar Robôs --------------\n";
    print "5 - Exlcuir Robô -------------\n";
    print "0 - Sair ------------------------\n";

    $opcao = readline("Informe a opção: ");

    switch ($opcao) {
        case 1:
            //Criar o objeto a ser persistido
            $robo = new RoboLego();
            $robo->setNomeRobo(readline("Informe o nome:  "));
            $robo->setTipoSistema(readline("Informe o tipo do sistema: "));
            $robo->setQuantRodas(readline("Informe a quantidade de rodas: "));
            $robo->setModalidade(readline("Informe a modalidae: "));
            $robo->setPremiacoes(readline("Informe as premiações: "));

            //Chamar o método do DAO para persistir o objeto
            $roboticaDAO = new RoboticaDAO();
            $roboticaDAO->inserirRobo($robo);

            print "Robô Lego cadastrado com sucesso!!\n\n";
            break;

        case 2:
            //Criar o objeto a ser persistido
            $robo = new RoboArduino();
            $robo->setNomeRobo(readline("Informe o nome:  "));
            $robo->setTipoPlaca(readline("Informe o tipo de placa: "));
            $robo->setQuantRodas(readline("Informe a quantidade de rodas: "));
            $robo->setModalidade(readline("Informe a modalidae: "));
            $robo->setPremiacoes(readline("Informe as premiações: "));

            //Chamar o método do DAO para persistir o objeto
            $roboticaDAO = new RoboticaDAO();
            $roboticaDAO->inserirRobo($robo);

            print "Robô Arduino cadastrado com sucesso!!\n\n";
            break;

        case 3:
            //Buscar os objetos no banco de dados
            $roboticaDAO = new RoboticaDAO();
            $robos = $roboticaDAO->listarRobos();

            //Exibir os dados dos objetos
            foreach ($robos as $r) {
                // Acessa os atributos comuns
                printf(
                    "%d - %s | %s | %s | %s | %s\n",
                    $r->getId(),
                    $r->getNomeRobo(),
                    method_exists($r, 'getTipoSistema') ? $r->getTipoSistema() : 'N/A',
                    $r->getQuantRodas(),
                    $r->getModalidade(),
                    method_exists($r, 'getTipoPlaca') ? $r->getTipoPlaca() : 'N/A',
                    $robo->getTipo()
                );
            }
            break;


        case 4:
            // 1. Ler o ID do robô
            $id = readline("Informe o ID do robô que deseja buscar: ");

            // 2. Chamar o método que retorna o objeto robô do banco de dados
            $roboticaDAO = new RoboticaDAO();
            $robo = $roboticaDAO->buscarPorId($id);

            // 3. Verificar se o robô retornado é diferente de NULL
            if ($robo !== null) {
                print "Robô encontrado:\n";
                printf(
                    "%d - %s | %s | %s | %s | %s | %s\n",
                    $robo->getId(),
                    $robo->getNomeRobo(),
                    method_exists($robo, 'getTipoSistema') ? $robo->getTipoSistema() : 'N/A',
                    $robo->getQuantRodas(),
                    $robo->getModalidade(),
                    method_exists($robo, 'getTipoPlaca') ? $robo->getTipoPlaca() : 'N/A',
                    $robo->getTipo()
                );
            } else {
                print "Robô não encontrado!\n";
            }
            break;

        case 5:
            // 1 - Listar os robôs
            $roboticaDAO = new RoboticaDAO();
            $robos = $roboticaDAO->listarRobos();

            // Exibir os dados dos objetos
            foreach ($robos as $r) {
                printf(
                    "%d- %s | %s | %s | %s | %s\n",
                    $r->getId(),
                    $r->getNomeRobo(),
                    method_exists($r, 'getTipoSistema') ? $r->getTipoSistema() : 'N/A',
                    $r->getQuantRodas(),
                    $r->getModalidade(),
                    method_exists($r, 'getTipoPlaca') ? $r->getTipoPlaca() : 'N/A'
                );
            }

            // 2 - Solicitar ao usuário para informar o ID
            $id = readline("Informe o ID do robô que deseja excluir: ");

            // 3 - Chamar o método do DAO para excluir o robô
            $roboticaDAO->excluirRobo($id);

            print "Robô excluído com sucesso!\n";
            break;


        case 0:
            print "Programa encerrado!\n";
            break;

        default:
            // Tratar opções inválidas ou não reconhecidas
            break;
    }
} while ($opcao != 0);
