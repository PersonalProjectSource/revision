<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;


/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="QuestionnaireBundle\Entity\Questionnaire", mappedBy="user")
     */
    private $questionnaires;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean", nullable=true)
     */
    private $actif;


    /**
     * Construit le user en utilisant le constructeur parent.
     */
    public function __construct() {
        parent::__construct();
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
     * Set nom
     *
     * @param string $nom
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     * @return User
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
     * Add scores
     *
     * @param \QuestionnaireBundle\Entity\Score $scores
     * @return User
     */
    public function addScore(\QuestionnaireBundle\Entity\Score $scores)
    {
        $this->scores[] = $scores;

        return $this;
    }

    /**
     * Remove scores
     *
     * @param \QuestionnaireBundle\Entity\Score $scores
     */
    public function removeScore(\QuestionnaireBundle\Entity\Score $scores)
    {
        $this->scores->removeElement($scores);
    }

    /**
     * Get scores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getScores()
    {
        return $this->scores;
    }

    /**
     * Add questionnaires
     *
     * @param \QuestionnaireBundle\Entity\Questionnaire $questionnaires
     * @return User
     */
    public function addQuestionnaire(\QuestionnaireBundle\Entity\Questionnaire $questionnaires)
    {
        $this->questionnaires[] = $questionnaires;

        return $this;
    }

    /**
     * Remove questionnaires
     *
     * @param \QuestionnaireBundle\Entity\Questionnaire $questionnaires
     */
    public function removeQuestionnaire(\QuestionnaireBundle\Entity\Questionnaire $questionnaires)
    {
        $this->questionnaires->removeElement($questionnaires);
    }

    /**
     * Get questionnaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestionnaires()
    {
        return $this->questionnaires;
    }
}
