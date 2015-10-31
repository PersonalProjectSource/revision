<?php

namespace QuestionnaireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Categorie
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
     * @ORM\OneToMany(targetEntity="Question", mappedBy="categorie")
     */
    private $questions;

    /**
     * @var string
     *
     * @ORM\Column(name="nomCat", type="string", length=255)
     */
    private $nomCat;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean")
     */
    private $actif;


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
     * Set nomCat
     *
     * @param string $nomCat
     * @return Categorie
     */
    public function setNomCat($nomCat)
    {
        $this->nomCat = $nomCat;

        return $this;
    }

    /**
     * Get nomCat
     *
     * @return string 
     */
    public function getNomCat()
    {
        return $this->nomCat;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     * @return Categorie
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
     * Constructor
     */
    public function __construct()
    {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add questions
     *
     * @param \QuestionnaireBundle\Entity\Question $questions
     * @return Categorie
     */
    public function addQuestion(\QuestionnaireBundle\Entity\Question $questions)
    {
        $this->questions[] = $questions;

        return $this;
    }

    /**
     * Remove questions
     *
     * @param \QuestionnaireBundle\Entity\Question $questions
     */
    public function removeQuestion(\QuestionnaireBundle\Entity\Question $questions)
    {
        $this->questions->removeElement($questions);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    public function __toString() {
        return $this->nomCat;
    }
}
