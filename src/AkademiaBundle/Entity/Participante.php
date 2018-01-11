<?php

namespace AkademiaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participante
 *
 * @ORM\Table(name="participante")
 * @ORM\Entity(repositoryClass="AkademiaBundle\Repository\ParticipanteRepository")
 */
class Participante
{

    /**
     * @ORM\OneToMany(targetEntity="Inscribete", mappedBy="participante")
     */
    private $inscripciones;    

    /**
     * @ORM\ManyToOne(targetEntity="Apoderado", inversedBy="participantes")
     * @ORM\JoinColumn(name="apoderado_id", referencedColumnName="id")
     */
    private $apoderado;

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
     * @ORM\Column(name="dni", type="string", length=255, unique=true)
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
     * @var \DateTime
     *
     * @ORM\Column(name="fechaNacimiento", type="date")
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=255)
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="parentesco", type="string", length=255)
     */
    private $parentesco;

    /**
     * @var string
     *
     * @ORM\Column(name="tipoDeSeguro", type="string", length=255)
     */
    private $tipoDeSeguro;


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
     * @return Participante
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
     * @return Participante
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
     * @return Participante
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
     * @return Participante
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
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return Participante
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
     * Set sexo
     *
     * @param string $sexo
     *
     * @return Participante
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
     * Set parentesco
     *
     * @param string $parentesco
     *
     * @return Participante
     */
    public function setParentesco($parentesco)
    {
        $this->parentesco = $parentesco;

        return $this;
    }

    /**
     * Get parentesco
     *
     * @return string
     */
    public function getParentesco()
    {
        return $this->parentesco;
    }

    /**
     * Set tipoDeSeguro
     *
     * @param string $tipoDeSeguro
     *
     * @return Participante
     */
    public function setTipoDeSeguro($tipoDeSeguro)
    {
        $this->tipoDeSeguro = $tipoDeSeguro;

        return $this;
    }

    /**
     * Get tipoDeSeguro
     *
     * @return string
     */
    public function getTipoDeSeguro()
    {
        return $this->tipoDeSeguro;
    }

    /**
     * Set apoderado
     *
     * @param \AkademiaBundle\Entity\Apoderado $apoderado
     *
     * @return Participante
     */
    public function setApoderado(\AkademiaBundle\Entity\Apoderado $apoderado = null)
    {
        $this->apoderado = $apoderado;

        return $this;
    }

    /**
     * Get apoderado
     *
     * @return \AkademiaBundle\Entity\Apoderado
     */
    public function getApoderado()
    {
        return $this->apoderado;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->inscripciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add inscripcione
     *
     * @param \AkademiaBundle\Entity\Inscribete $inscripcione
     *
     * @return Participante
     */
    public function addInscripcione(\AkademiaBundle\Entity\Inscribete $inscripcione)
    {
        $this->inscripciones[] = $inscripcione;

        return $this;
    }

    /**
     * Remove inscripcione
     *
     * @param \AkademiaBundle\Entity\Inscribete $inscripcione
     */
    public function removeInscripcione(\AkademiaBundle\Entity\Inscribete $inscripcione)
    {
        $this->inscripciones->removeElement($inscripcione);
    }

    /**
     * Get inscripciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInscripciones()
    {
        return $this->inscripciones;
    }
}
