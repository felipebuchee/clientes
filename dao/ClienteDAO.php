<?php
require_once("modelo/Cliente.php");
require_once("modelo/ClientePF.php");
require_once("modelo/ClientePJ.php");

require_once("util/Conexao.php");

class ClienteDAO
{

    //Método para inserir um cliente
    public function inserirCliente(Cliente $cliente)
    {

        $sql = "INSERT INTO clientes (tipo, nome_social, email, nome, cpf, razao_social, cnpj)
        VALUES
        (?, ?, ?, ?, ?, ?, ?)";

        $con = Conexao::getCon();

        $stm = $con->prepare($sql);
        if ($cliente instanceof ClientePF) {
            $stm->execute(array(
                $cliente->getTipo(),
                $cliente->getNomeSocial(),
                $cliente->getEmail(),
                $cliente->getNome(),
                $cliente->getCpf(),
                null,
                null
            ));
        } else if ($cliente instanceof ClientePJ) {
            $stm->execute(array(
                $cliente->getTipo(),
                $cliente->getNomeSocial(),
                $cliente->getEmail(),
                null,
                null,
                $cliente->getRazaoSocial(),
                $cliente->getCnpj(),
            ));
        }
    }

    //Método listar clientes
    public function listarClientes()
    {
        $sql = "SELECT * FROM clientes";

        $con = Conexao::getCon();

        $stm = $con->prepare($sql);
        $stm->execute();
        $registros = $stm->fetchAll();

        $clientes = $this->mapClientes($registros);
        return $clientes;
    }

    private function mapClientes(array $registros)
    { //Vai mapear os dados do banco para o objeto, pois os dados estão ainda como um array associativo
        $clientes = array();

        foreach ($registros as $reg) {
            $cliente = null;
            if ($reg['tipo'] == 'F') {
                $cliente = new ClientePF();
                $cliente->setNome($reg['nome']);
                $cliente->setCpf($reg['cpf']);
            } else {
                $cliente = new ClientePJ();
                $cliente->setRazaoSocial($reg['razao_social']);
                $cliente->setCnpj($reg['cnpj']);
            }

            $cliente->setId($reg['id']);
            $cliente->setNomeSocial($reg['nome_social']);
            $cliente->setEmail($reg['email']);
            array_push($clientes, $cliente);
        }
        return $clientes;
    }

    public function buscarPorId(int $id)
    {
        $sql = "SELECT * FROM clientes WHERE id = ?";

        $con = Conexao::getCon();
        $stm = $con->prepare($sql);
        $stm->execute([$id]);
        $registro = $stm->fetch();

        if ($registro) {

            // Mapear o registro para um objeto Cliente
            if ($registro['tipo'] == 'F') {
                $cliente = new ClientePF();
                $cliente->setNome($registro['nome']);
                $cliente->setCpf($registro['cpf']);
            } else {
                $cliente = new ClientePJ();
                $cliente->setRazaoSocial($registro['razao_social']);
                $cliente->setCnpj($registro['cnpj']);
            }

            $cliente->setId($registro['id']);
            $cliente->setNomeSocial($registro['nome_social']);
            $cliente->setEmail($registro['email']);
            return $cliente;
        }

        // Retorna null caso o cliente não seja encontrado
        return null;
    }
}
