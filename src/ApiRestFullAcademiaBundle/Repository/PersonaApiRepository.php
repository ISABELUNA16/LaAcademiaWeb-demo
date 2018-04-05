<?php

namespace ApiRestFullAcademiaBundle\Repository;

/**
 * PersonaApiRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PersonaApiRepository extends \Doctrine\ORM\EntityRepository
{

    public function beneficiarioAllFind($inicio,$fin,$idDisciplina){

        $query = "WITH ParticipantesOrdenados AS  
                    (  
                    SELECT
                    ROW_NUMBER() OVER(ORDER BY par.id ASC) AS num_id,
                    ins.id idInscribete,
                    per.pernombres as nombre,
                    per.perapepaterno as apellidoPaterno,
                    per.perapematerno as apellidoMaterno,
                    (cast(datediff(dd,per.perfecnacimiento,GETDATE()) / 365.25 as int)) as edad,
                    per.persexo as sexo,
                    ede.ede_nombre as nombreComplejo,
                    dis.dis_descripcion as nombreDisciplina,
                    ('http://172.16.20.55/academia/web/' + par.ficha_ruta) as ficha_tecnica,
                    ('http://172.16.20.55/academia/web/' + par.foto_ruta) as foto,
                    par.link as link,
                    par.visible_app as visibilidad,
                    par.comentarios as comentarios      
                    FROM  ACADEMIA.movimientos AS mov
                    INNER JOIN (SELECT m.inscribete_id as mov_ins_id, MAX(m.id) mov_id FROM ACADEMIA.movimientos m
                    GROUP BY m.inscribete_id) ids ON mov.id = ids.mov_id
                    
                    INNER JOIN ACADEMIA.inscribete ins ON ins.id = ids.mov_ins_id
                    INNER JOIN academia.horario hor on ins.horario_id = hor.id
                    INNER JOIN catastro.edificacionDisciplina edi on edi.edi_codigo = hor.edi_codigo
                    INNER JOIN catastro.disciplina dis on dis.dis_codigo = edi.dis_codigo
                    INNER JOIN catastro.edificacionesdeportivas ede on ede.ede_codigo = edi.ede_codigo 
                    INNER JOIN academia.participante par on ins.participante_id = par.id
                    INNER JOIN grpersona per on per.percodigo = par.percodigo 
                    
                    WHERE mov.asistencia_id=2 AND mov.categoria_id = 4 AND dis.dis_codigo='$idDisciplina'
                    )  
                    SELECT idInscribete talentoId,
                            nombre talentoNombre,
                            apellidoMaterno talentoApellidoMaterno,
                            apellidoPaterno talentoApellidoPaterno,
                            edad talentoEdad,
                            sexo talentoSexo, 
                            nombreComplejo complejoDeportivoNombre,
                            nombreDisciplina disciplinaDeportivaNombre,
                            foto talentoFotoPerfil,
                            ficha_tecnica talentoFotoFicha,
                            link talentoVideo,
                            visibilidad,
                            comentarios talentoComentarios   
                        FROM ParticipantesOrdenados   
                        WHERE num_id  BETWEEN '$inicio' AND '$fin';";
        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $persona = $stmt->fetchAll();
        return $persona;
    }

    public function disciplinaAllGeneral(){
        $query = "        
                    WITH ParticipantesOrdenados AS  
                    (  
                    SELECT
                    dis.dis_descripcion as disciplinaNombre,
                    dis.dis_codigo disciplinaId      
                    FROM  ACADEMIA.movimientos AS mov
                    INNER JOIN (SELECT m.inscribete_id as mov_ins_id, MAX(m.id) mov_id FROM ACADEMIA.movimientos m
                    GROUP BY m.inscribete_id) ids ON mov.id = ids.mov_id
                    
                    INNER JOIN ACADEMIA.inscribete ins ON ins.id = ids.mov_ins_id
                    INNER JOIN academia.horario hor on ins.horario_id = hor.id
                    INNER JOIN catastro.edificacionDisciplina edi on edi.edi_codigo = hor.edi_codigo
                    INNER JOIN catastro.disciplina dis on dis.dis_codigo = edi.dis_codigo
                    INNER JOIN catastro.edificacionesdeportivas ede on ede.ede_codigo = edi.ede_codigo 
                    INNER JOIN academia.participante par on ins.participante_id = par.id
                    INNER JOIN grpersona per on per.percodigo = par.percodigo 
                    
                    WHERE mov.asistencia_id=2 AND mov.categoria_id = 4
                    )  
                    SELECT distinct 
                            disciplinaId,
                            disciplinaNombre  
                        FROM ParticipantesOrdenados ";

        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $disciplinas = $stmt->fetchAll();
        return $disciplinas;
    }

    public function departamentoAll(){

        $query = "        
                    WITH ParticipantesOrdenados AS  
                    (  
                    SELECT
                    ROW_NUMBER() OVER(ORDER BY par.id ASC) AS num_id,
                    ubi.ubidpto departamentoId

                    FROM  ACADEMIA.movimientos AS mov
                    INNER JOIN (SELECT m.inscribete_id as mov_ins_id, MAX(m.id) mov_id FROM ACADEMIA.movimientos m
                    GROUP BY m.inscribete_id) ids ON mov.id = ids.mov_id
                    
                    INNER JOIN ACADEMIA.inscribete ins ON ins.id = ids.mov_ins_id
                    INNER JOIN academia.horario hor on ins.horario_id = hor.id
                    INNER JOIN catastro.edificacionDisciplina edi on edi.edi_codigo = hor.edi_codigo
                    INNER JOIN catastro.disciplina dis on dis.dis_codigo = edi.dis_codigo
                    INNER JOIN catastro.edificacionesdeportivas ede on ede.ede_codigo = edi.ede_codigo 
                    INNER JOIN academia.participante par on ins.participante_id = par.id
                    INNER JOIN grpersona per on per.percodigo = par.percodigo 
                    INNER JOIN grubigeo as ubi ON ubi.ubicodigo = ede.ubicodigo
                    WHERE mov.asistencia_id=2 AND mov.categoria_id = 4
                    )  
                        SELECT distinct departamentoId, grubi.ubinombre departamentoNombre
                        FROM ParticipantesOrdenados po
                        INNER JOIN grubigeo grubi ON grubi.ubidpto = po.departamentoId     
                        WHERE 
                        ubidistrito = '00' AND ubidpto != '00' AND ubiprovincia = '00'";

        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $departamentos = $stmt->fetchAll();
        return $departamentos;  
    }

    public function provinciaAll($departamentoId){

        $query = "        
                    WITH ParticipantesOrdenados AS  
                    (  
                    SELECT
                    ROW_NUMBER() OVER(ORDER BY par.id ASC) AS num_id,
                    ubi.ubidpto departamentoId,
                    ubi.ubiprovincia provinciaId

                    FROM  ACADEMIA.movimientos AS mov
                    INNER JOIN (SELECT m.inscribete_id as mov_ins_id, MAX(m.id) mov_id FROM ACADEMIA.movimientos m
                    GROUP BY m.inscribete_id) ids ON mov.id = ids.mov_id
                    
                    INNER JOIN ACADEMIA.inscribete ins ON ins.id = ids.mov_ins_id
                    INNER JOIN academia.horario hor on ins.horario_id = hor.id
                    INNER JOIN catastro.edificacionDisciplina edi on edi.edi_codigo = hor.edi_codigo
                    INNER JOIN catastro.disciplina dis on dis.dis_codigo = edi.dis_codigo
                    INNER JOIN catastro.edificacionesdeportivas ede on ede.ede_codigo = edi.ede_codigo 
                    INNER JOIN academia.participante par on ins.participante_id = par.id
                    INNER JOIN grpersona per on per.percodigo = par.percodigo 
                    INNER JOIN grubigeo as ubi ON ubi.ubicodigo = ede.ubicodigo
                    WHERE mov.asistencia_id=2 AND mov.categoria_id = 4
                    )  
                    SELECT  distinct departamentoId,provinciaId ,grubi.ubinombre provinciaNombre   
                    FROM ParticipantesOrdenados po
                    INNER JOIN grubigeo grubi ON grubi.ubidpto = po.departamentoId
                    WHERE  
                    ubidistrito ='00' AND ubidpto != '00' AND ubiprovincia !='00' 
                    AND grubi.ubiprovincia = po.provinciaId
                    AND ubidpto = '$departamentoId' ";

        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $provincias = $stmt->fetchAll();
        return $provincias;  
    }


    public function distritoAll($departamentoId,$provinciaId){

        $query = "        
                   WITH ParticipantesOrdenados AS  
                    (  
                    SELECT
                    ROW_NUMBER() OVER(ORDER BY par.id ASC) AS num_id,
                    ubi.ubidpto idDepartamento,
                    ubi.ubiprovincia idProvincia,
                    ubi.ubidistrito idDistrito,
                    ubi.ubicodigo disUbicodigo,
                    ede.ede_codigo idComplejo  
                    FROM  ACADEMIA.movimientos AS mov
                    INNER JOIN (SELECT m.inscribete_id as mov_ins_id, MAX(m.id) mov_id FROM ACADEMIA.movimientos m
                    GROUP BY m.inscribete_id) ids ON mov.id = ids.mov_id
                    
                    INNER JOIN ACADEMIA.inscribete ins ON ins.id = ids.mov_ins_id
                    INNER JOIN academia.horario hor on ins.horario_id = hor.id
                    INNER JOIN catastro.edificacionDisciplina edi on edi.edi_codigo = hor.edi_codigo
                    INNER JOIN catastro.disciplina dis on dis.dis_codigo = edi.dis_codigo
                    INNER JOIN catastro.edificacionesdeportivas ede on ede.ede_codigo = edi.ede_codigo 
                    INNER JOIN academia.participante par on ins.participante_id = par.id
                    INNER JOIN grpersona per on per.percodigo = par.percodigo 
                    INNER JOIN grubigeo as ubi ON ubi.ubicodigo = ede.ubicodigo
                    WHERE mov.asistencia_id=2 AND mov.categoria_id = 4
                    )  
                    SELECT distinct idDepartamento departamentoId ,idProvincia provinciaId ,idDistrito distritoId,
                      disUbicodigo ubicodigo ,  grubi.ubinombre distritoNombre   
                    FROM ParticipantesOrdenados po
                    INNER JOIN grubigeo grubi ON grubi.ubidpto= po.idDepartamento
                    WHERE  
                    ubidistrito != '00' AND ubidpto != '00' AND ubiprovincia !='00' 
                    AND grubi.ubiprovincia = po.idProvincia
                    AND grubi.ubidistrito = po.idDistrito AND ubidpto='$departamentoId' AND ubiprovincia='$provinciaId'";

        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $distritos = $stmt->fetchAll();
        return $distritos;  
    }



    public function complejoDeportivoAll($ubicodigo){

        $query = "        
                  SELECT distinct
                    ede.ede_codigo complejoId,  
                    ede.ede_nombre complejoNombre,
                    ubi.ubicodigo ubicodigo
                    FROM  ACADEMIA.movimientos AS mov
                    INNER JOIN (SELECT m.inscribete_id as mov_ins_id, MAX(m.id) mov_id FROM ACADEMIA.movimientos m
                    GROUP BY m.inscribete_id) ids ON mov.id = ids.mov_id
                    
                    INNER JOIN ACADEMIA.inscribete ins ON ins.id = ids.mov_ins_id
                    INNER JOIN academia.horario hor on ins.horario_id = hor.id
                    INNER JOIN catastro.edificacionDisciplina edi on edi.edi_codigo = hor.edi_codigo
                    INNER JOIN catastro.disciplina dis on dis.dis_codigo = edi.dis_codigo
                    INNER JOIN catastro.edificacionesdeportivas ede on ede.ede_codigo = edi.ede_codigo
                    INNER JOIN grubigeo ubi on ede.ubicodigo = ubi.ubicodigo 
                    WHERE mov.asistencia_id=2 AND mov.categoria_id = 4 AND ubi.ubicodigo = '$ubicodigo' ";

        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $complejos = $stmt->fetchAll();
        return $complejos;  
    }


    public function disciplinaAll($complejoId){
        $query = "        
                SELECT distinct
                ede.ede_codigo complejoId,  
                dis.dis_codigo disciplinaId,
                dis.dis_descripcion disciplinaNombre
                FROM  ACADEMIA.movimientos AS mov
                INNER JOIN (SELECT m.inscribete_id as mov_ins_id, MAX(m.id) mov_id FROM ACADEMIA.movimientos m
                GROUP BY m.inscribete_id) ids ON mov.id = ids.mov_id
                
                INNER JOIN ACADEMIA.inscribete ins ON ins.id = ids.mov_ins_id
                INNER JOIN academia.horario hor on ins.horario_id = hor.id
                INNER JOIN catastro.edificacionDisciplina edi on edi.edi_codigo = hor.edi_codigo
                INNER JOIN catastro.disciplina dis on dis.dis_codigo = edi.dis_codigo
                INNER JOIN catastro.edificacionesdeportivas ede on ede.ede_codigo = edi.ede_codigo
                INNER JOIN grubigeo ubi on ede.ubicodigo = ubi.ubicodigo 
                WHERE mov.asistencia_id=2 AND mov.categoria_id = 4 AND ede.ede_codigo='$complejoId' ";

        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $disciplinas = $stmt->fetchAll();
        return $disciplinas;  
    }

     public function indicadoresTalento($idParticipante){

        $query = "WITH controlMaximo AS ( 
                    SELECT  MAX(ic.control_id) as maximoControl
                    FROM   
                    ACADEMIA.indicador_control ic INNER JOIN ACADEMIA.control co on ic.control_id = co.id 
                    WHERE co.id_participante = $idParticipante    
                )

                SELECT ic.indicador_id, ind.descripcion,ind.unidad_medida, ic.control_id, ic.valor,co.id_participante,CONVERT(varchar,co.fecha,105) fecha 
                FROM 
                ACADEMIA.indicador_control ic INNER JOIN ACADEMIA.control co on ic.control_id = co.id 
                INNER JOIN controlMaximo cm on ic.control_id = cm.maximoControl
                INNER JOIN ACADEMIA.indicador ind on ind.id = ic.indicador_id 
                WHERE co.id_participante = $idParticipante ";

        $stmt = $this->getEntityManager()->getConnection()->prepare($query);
        $stmt->execute();
        $controles = $stmt->fetchAll();

        return $controles;

    }


}
