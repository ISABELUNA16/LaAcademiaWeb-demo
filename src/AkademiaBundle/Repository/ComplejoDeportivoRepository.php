<?php

namespace AkademiaBundle\Repository;

/**
 * ComplejoDeportivoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ComplejoDeportivoRepository extends \Doctrine\ORM\EntityRepository
{


	public function getComplejosDeportivos(){

       $query = "select ede_codigo as id, ede_nombre as nombre ,ubicodigo , ede_direccion as direccion from CATASTRO.edificacionesdeportivas;";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $complejosDeportivos = $stmt->fetchAll();

        return $complejosDeportivos;        		
	}

}
