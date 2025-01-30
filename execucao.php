<?php
require_once("modelo/ClientePF.php");
require_once("modelo/ClientePJ.php");
require_once("dao/ClienteDAO.php");

//Teste conexao
/*require_once("util/Conexao.php");
$con = Conexao::getCon();
print_r($con);*/

do {

    print "\n\n--- CADASTRO CLIENTES------------\n";
    print "1 - Cadastrar Cliente PF --------\n";
    print "2 - Cadastrar Cliente PJ --------\n";
    print "3 - Listar Cliente --------------\n";
    print "4 - Buscar Cliente --------------\n";
    print "5 - Exlcuir Cliente -------------\n";
    print "0 - Sair ------------------------\n";

    $opcao = readline("Informe a opção: ");

    switch ($opcao) {
        case 1:
            //Criar o objeto a ser persistido
            $cliente = new ClientePF();
            $cliente->setNome(readline("Informe o nome:  "));
            $cliente->setNomeSocial(readline("Informe o nome social: "));
            $cliente->setCpf(readline("Informe o CPF: "));
            $cliente->setEmail(readline("Informe o email: "));

            //Chamar o método do DAO para persistir o objeto
            $clienteDAO = new ClienteDAO();
            $clienteDAO->inserirCliente($cliente);

            print "Cliente PF cadastrado com sucesso!!\n\n";
            break;

        case 2:
            //Criar o objeto a ser persistido
            $cliente = new ClientePJ();
            $cliente->setRazaoSocial(readline("Informe a razão social:  "));
            $cliente->setNomeSocial(readline("Informe o nome social: "));
            $cliente->setCnpj(readline("Informe o CNPJ: "));
            $cliente->setEmail(readline("Informe o email: "));

            //Chamar o método do DAO para persistir o objeto
            $clienteDAO = new ClienteDAO();
            $clienteDAO->inserirCliente($cliente);

            print "Cliente PJ cadastrado com sucesso!!\n\n";
            break;

        case 3:
            //Buscar os objetos no banco de dados
            $clienteDAO = new ClienteDAO();
            $clientes = $clienteDAO->listarClientes();

            //Exibir os dados dos objetos
            foreach ($clientes as $c) {
                printf("%d- %s | %s | %s | %s\n", $c->getId(), $c->getTipo(), $c->getNomeSocial(), $c->getIdentificacao(), $c->getNroDoc(), $c->getEmail());
            }
            break;

        case 4:
            // 1. Ler o ID do cliente
            $id = readline("Informe o ID do cliente que deseja buscar: ");

            // 2. Chamar o método que retorna o objeto cliente do banco de dados
            $clienteDAO = new ClienteDAO();
            $cliente = $clienteDAO->buscarPorId($id);

            // 3. Verificar se o cliente retornado é diferente de NULL
            if ($cliente !== null) {
                print "Cliente encontrado:\n";
                printf(
                    "%d- %s | %s|  %s | %s\n",
                    $cliente->getId(),
                    $cliente->getTipo(),
                    $cliente->getNomeSocial(),
                    $cliente->getIdentificacao(),
                    $cliente->getEmail()
                );
            } else {
                print "Cliente não encontrado!\n";
            }
            break;


        case 5:
            // 1 - Listar os clientes
            $clienteDAO = new ClienteDAO();
            $clientes = $clienteDAO->listarClientes();

            //Exibir os dados dos objetos
            foreach ($clientes as $c) {
                printf("%d- %s | %s | %s | %s\n", $c->getId(), $c->getTipo(), $c->getNomeSocial(), $c->getIdentificacao(), $c->getNroDoc(), $c->getEmail());
            }

            // 2 - Solicitar ao usúario para informar o id
            $id = readline("Informe o ID do cliente que deseja excluir: ");

            // 3 - Chamar o método do DAO para excluir o cliente
            $clienteDAO->excluirCliente($id);

            print "Cliente excluído com sucesso!\n";
            break;
        case 0:
            print "Programa encerrado!\n";
            break;

        default:
            # code...
            break;
    }
} while ($opcao != 0);
