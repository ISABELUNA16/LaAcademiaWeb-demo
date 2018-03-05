<?php

namespace AkademiaBundle\Repository;

/**
 * ParticipanteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ParticipanteRepository extends \Doctrine\ORM\EntityRepository
{

	public function getbuscarParticipante($dni){

        $query = "SELECT id from ACADEMIA.participante where dni='$dni'";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $dni = $stmt->fetchAll();

    	return $dni;
	}

    public function getbuscarParticipantePersona($dni){

        $query ="SELECT percodigo as id from grpersona where perdni='$dni'";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $dni = $stmt->fetchAll();

        return $dni;
    }

    public function getbuscarParticipanteApoderado($dni){

        $query = "SELECT top 1 id,apoderado_id from ACADEMIA.participante where dni='$dni' and estado=0 order by id DESC";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $dni = $stmt->fetchAll();

        return $dni;
    }


    public function maxDniAcademiaPart($dni){

        $query = "SELECT MAX(id) as id from academia.participante where dni = '$dni' group by(dni)";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $codigo = $stmt->fetchAll();

        return $codigo;
    }

    public function getActualizarApoderado($idApod, $idParticipante){
        $query = "UPDATE ACADEMIA.participante SET apoderado_id ='$idApod'  WHERE id='$idParticipante'; ";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
    }

    
    public function getActualizarParticipanteFicha($idParticipante, $ficha){
        $query = "UPDATE ACADEMIA.inscribete SET participante_id ='$idParticipante'  WHERE id='$ficha'; ";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
    }
}

