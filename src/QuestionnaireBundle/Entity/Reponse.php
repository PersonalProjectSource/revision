<?php

namespace QuestionnaireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reponse
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Reponse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="reponses", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", nullable=true)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="text")
     */
    private $libelle;

    /**
     * @var boolean
     *
     * @ORM\Column(name="vrai", type="boolean", nullable=true)
     */
    private $vrai;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean", nullable=true)
     */
    private $actif;

    function __construct()
    {
        $this->vrai = false;
        $this->actif = true;
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Reponse
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set vrai
     *
     * @param boolean $vrai
     * @return Reponse
     */
    public function setVrai($vrai)
    {
        $this->vrai = $vrai;

        return $this;
    }

    /**
     * Get vrai
     *
     * @return boolean 
     */
    public function getVrai()
    {
        return $this->vrai;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     * @return Reponse
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif
     *
     * @return boolean 
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Set question
     *
     * @param \QuestionnaireBundle\Entity\Question $question
     * @return Reponse
     */
    public function setQuestion(\QuestionnaireBundle\Entity\Question $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \QuestionnaireBundle\Entity\Question 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    public function __toString() {
        return $this->libelle;
    }

}
