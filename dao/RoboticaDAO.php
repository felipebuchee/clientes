<?php
require_once("modelo/Robo.php");
require_once("modelo/RoboLego.php");
require_once("modelo/RoboArduino.php");

require_once("util/Conexao.php");

class RoboticaDAO
{

    //Método para inserir um cliente
    public function inserirRobo(Robo $robo)
    {

        $sql = "INSERT INTO robo (nome, tipo_sistema, quant_rodas, modalidade, premiacoes, tipo_placa, tipo)
        VALUES
        (?, ?, ?, ?, ?, ?, ?)";

        $con = Conexao::getCon();

        $stm = $con->prepare($sql);
        if ($robo instanceof RoboLego) {
            $stm->execute(array(
                $robo->getNomeRobo(),
                $robo->getTipoSistema(),
                $robo->getQuantRodas(),
                $robo->getModalidade(),
                $robo->getPremiacoes(),
                null,
                $robo->getTipo()

            ));
        } else if ($robo instanceof RoboArduino) {
            $stm->execute(array(
                $robo->getNomeRobo(),
                null,
                $robo->getQuantRodas(),
                $robo->getModalidade(),
                $robo->getPremiacoes(),
                $robo->getTipoPlaca(),
                $robo->getTipo()
            ));
        }
    }

    //Método listar clientes
    public function listarRobos()
    {
        $sql = "SELECT * FROM robo";

        $con = Conexao::getCon();
        $stm = $con->prepare($sql);
        $stm->execute();
        $registros = $stm->fetchAll();

        $robos = $this->mapRobos($registros);
        return $robos;
    }


    private function mapRobos(array $registros)
    {
        $robos = array();

        foreach ($registros as $reg) {
            $robo = null;

            if ($reg['tipo'] === 'Arduino') {
                $robo = new RoboArduino();
                $robo->setTipoPlaca($reg['tipo_placa']);
            } elseif ($reg['tipo'] === 'Lego') {
                $robo = new RoboLego();
                $robo->setTipoSistema($reg['tipo_sistema']);
            } else {
                continue;
            }

            // Atributos comuns a todos os robôs
            $robo->setId($reg['id']);
            $robo->setNomeRobo($reg['nome']);
            $robo->setQuantRodas($reg['quant_rodas']);
            $robo->setModalidade($reg['modalidade']);
            $robo->setPremiacoes($reg['premiacoes']);

            array_push($robos, $robo);
        }
        return $robos;
    }




    public function buscarPorId(int $id)
{
    $sql = "SELECT * FROM robo WHERE id = ?";

    $con = Conexao::getCon();
    $stm = $con->prepare($sql);
    $stm->execute([$id]);
    $registro = $stm->fetch();

    if ($registro) {

        // Mapear o registro para o tipo correto de robô
        if ($registro['tipo'] == 'Arduino') {
            $robo = new RoboArduino();
            $robo->setTipoPlaca($registro['tipo_placa']);
        } elseif ($registro['tipo'] == 'Lego') {
            $robo = new RoboLego();
            $robo->setTipoSistema($registro['tipo_sistema']);
        } else {
            // Caso o tipo não seja identificado
            return null;
        }

        // Atributos comuns a todos os robôs
        $robo->setId($registro['id']);
        $robo->setNomeRobo($registro['nome']);
        $robo->setQuantRodas($registro['quant_rodas']);
        $robo->setModalidade($registro['modalidade']);
        $robo->setPremiacoes($registro['premiacoes']);
        
        return $robo;
    }

    // Retorna null caso o robô não seja encontrado
    return null;
}



public function excluirRobo($id)
{
    $sql = "DELETE FROM robo WHERE id = ?";

    $con = Conexao::getCon();
    $stm = $con->prepare($sql);
    $stm->execute([$id]);
}
}