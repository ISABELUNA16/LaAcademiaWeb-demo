<?php

namespace AkademiaBundle\Repository;

/**
 * DistritoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DistritoRepository extends \Doctrine\ORM\EntityRepository
{


	public function getDepartamentos(){

        $query = "select ubidpto as id ,ubinombre as nombre from grubigeo where ubiprovincia='00' and ubidistrito='00' AND ubidpto!='00';";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $departamentos = $stmt->fetchAll();

        return $departamentos;

	}


	public function getProvincias(){

        $query = "select ubidpto as idDepartamento,ubiprovincia as idProvincia , ubinombre as nombreProvincia from grubigeo where ubidistrito='00' AND ubidpto!='00' AND ubiprovincia!='00';";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $provincias = $stmt->fetchAll();

        return $provincias; 		
	}

	public function getDistritos(){

       $query = "select ubidpto as idDepartamento,ubiprovincia as idProvincia, ubicodigo as idDistrito ,ubinombre as nombreDistrito from grubigeo where ubidistrito!='00' AND ubidpto!='00' AND ubiprovincia!='00';";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $distritos = $stmt->fetchAll();

        return $distritos;		
	}


    public function getDitritosCD(){

       $query = " select  DISTINCT grubigeo.ubidpto as idDepartamento, grubigeo.ubiprovincia as idProvincia,grubigeo.ubicodigo as idDistrito,grubigeo.ubinombre as nombreDistrito from CATASTRO.edificacionesdeportivas as edificacionesdeportivas,grubigeo where edificacionesdeportivas.ubicodigo = grubigeo.ubicodigo and   edificacionesdeportivas.ede_estado = 1;";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $distritosCD = $stmt->fetchAll();

        return $distritosCD;  

    }

    public function getProvinciasCD(){

        $query = " select  ubidpto as idDepartamento,ubiprovincia as idProvincia , ubinombre as nombreProvincia 
   from grubigeo where ubidistrito='00' AND ubidpto!='00' AND ubiprovincia!='00' and (ubidpto = 24
   and ubiprovincia = 01) or (ubidpto = 14 and ubiprovincia = 01) and ubidistrito = 0;";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $provinciasCD = $stmt->fetchAll();

        return $provinciasCD;         
    }

    public function getDepartamentosCD(){

        $query = "select ubidpto as id ,ubinombre as nombre from grubigeo where ubiprovincia='00' and ubidistrito='00' AND ubidpto!='00' and ubicodigo=24 or ubicodigo=14;";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $departamentosCD = $stmt->fetchAll();

        return $departamentosCD;

    }
    
}
