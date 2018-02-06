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

        $query = "select id from ACADEMIA.participante where dni='$dni' and estado = 1";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $dni = $stmt->fetchAll();

    	return $dni;
	}

    public function getbuscarParticipanteApoderado($dni){

        $query = "select top 1 id,apoderado_id from ACADEMIA.participante where dni='$dni' and estado=0";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $dni = $stmt->fetchAll();

        return $dni;
    }


    public function getActualizarApoderado($idApod, $dni){
        $query = "UPDATE ACADEMIA.participante SET apoderado_id ='$idApod'  WHERE dni='$dni'; ";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
    }

     public function getActualizarParticipanteFicha($idParticipante, $ficha){
        $query = "UPDATE ACADEMIA.inscribete SET participante_id ='$idParticipante'  WHERE id='$ficha'; ";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
    }


}

