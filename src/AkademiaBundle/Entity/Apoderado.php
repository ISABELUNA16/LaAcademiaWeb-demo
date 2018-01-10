<?php

namespace AkademiaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Apoderado
 *
 * @ORM\Table(name="apoderado")
 * @ORM\Entity(repositoryClass="AkademiaBundle\Repository\ApoderadoRepository")
 */
class Apoderado
{


    /**
     * @ORM\OneToMany(targetEntity="Participante", mappedBy="apoderado")
     */
    private $participantes;

    /**
     * @ORM\ManyToOne(targetEntity="Distrito", inversedBy="apoderados")
     * @ORM\JoinColumn(name="distrito_id", referencedColumnName="id")
     */

    private $distrito;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=8, unique=true)
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidoPaterno", type="string", length=255)
     */
    private $apellidoPaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidoMaterno", type="string", length=255)
     */
    private $apellidoMaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=255)
     */
    private $sexo;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaNacimiento", type="date")
     */
    private $fechaNacimiento;


    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=9)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=255)
     */
    private $correo;




    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dni
     *
     * @param string $dni
     *
     * @return Apoderado
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set apellidoPaterno
     *
     * @param string $apellidoPaterno
     *
     * @return Apoderado
     */
    public function setApellidoPaterno($apellidoPaterno)
    {
        $this->apellidoPaterno = $apellidoPaterno;

        return $this;
    }

    /**
     * Get apellidoPaterno
     *
     * @return string
     */
    public function getApellidoPaterno()
    {
        return $this->apellidoPaterno;
    }

    /**
     * Set apellidoMaterno
     *
     * @param string $apellidoMaterno
     *
     * @return Apoderado
     */
    public function setApellidoMaterno($apellidoMaterno)
    {
        $this->apellidoMaterno = $apellidoMaterno;

        return $this;
    }

    /**
     * Get apellidoMaterno
     *
     * @return string
     */
    public function getApellidoMaterno()
    {
        return $this->apellidoMaterno;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Apoderado
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     *
     * @return Apoderado
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Apoderado
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Apoderado
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set correo
     *
     * @param string $correo
     *
     * @return Apoderado
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set distrito
     *
     * @param \AkademiaBundle\Entity\Distrito $distrito
     *
     * @return Apoderado
     */
    public function setDistrito(\AkademiaBundle\Entity\Distrito $distrito = null)
    {
        $this->distrito = $distrito;

        return $this;
    }

    /**
     * Get distrito
     *
     * @return \AkademiaBundle\Entity\Distrito
     */
    public function getDistrito()
    {
        return $this->distrito;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return Apoderado
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento->format('Y-m-d');
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->participantes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add participante
     *
     * @param \AkademiaBundle\Entity\Participante $participante
     *
     * @return Apoderado
     */
    public function addParticipante(\AkademiaBundle\Entity\Participante $participante)
    {
        $this->participantes[] = $participante;

        return $this;
    }

    /**
     * Remove participante
     *
     * @param \AkademiaBundle\Entity\Participante $participante
     */
    public function removeParticipante(\AkademiaBundle\Entity\Participante $participante)
    {
        $this->participantes->removeElement($participante);
    }

    /**
     * Get participantes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipantes()
    {
        return $this->participantes;
    }
}
