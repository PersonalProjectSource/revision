<?php

namespace QuestionnaireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Question
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Question
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

//    /**
//     * @ORM\ManyToMany(targetEntity="Questionnaire",  inversedBy="questions", cascade={"persist", "remove"})
//     */
//    private $questionnaires;

    /**
     * @ORM\OneToMany(targetEntity="Question_questionnaire",  mappedBy="question", cascade={"all"})
     */
    private $questionnaire;

    /**
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="questions")
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity="Reponse",  mappedBy="question", cascade={"persist", "remove"})
     */
    private $reponses;

    /**
     * @var string
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var boolean
     * @ORM\Column(name="actif", type="boolean", nullable=true)
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
     * Set libelle
     *
     * @param string $libelle
     * @return Question
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
     * Set actif
     *
     * @param boolean $actif
     * @return Question
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
     * Set categorie
     *
     * @param \QuestionnaireBundle\Entity\Categorie $categorie
     * @return Question
     */
    public function setCategorie(\QuestionnaireBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \QuestionnaireBundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reponses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add reponses
     *
     * @param \QuestionnaireBundle\Entity\Reponse $reponses
     * @return Question
     */
    public function addReponse(\QuestionnaireBundle\Entity\Reponse $reponses)
    {
        $reponses->setQuestion($this);
        $this->reponses[] = $reponses;

        return $this;
    }

    /**
     * Remove reponses
     *
     * @param \QuestionnaireBundle\Entity\Reponse $reponses
     */
    public function removeReponse(\QuestionnaireBundle\Entity\Reponse $reponses)
    {
        $this->reponses->removeElement($reponses);
    }

    /**
     * Get reponses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReponses()
    {
        return $this->reponses;
    }

    /**
     * Add questionnaire
     *
     * @param \QuestionnaireBundle\Entity\Question_questionnaire $questionnaire
     * @return Question
     */
    public function addQuestionnaire(\QuestionnaireBundle\Entity\Question_questionnaire $questionnaire)
    {
//        $questionnaire->setQuestions($this);
        $this->questionnaire[] = $questionnaire;

        return $this;
    }

    /**
     * Remove questionnaire
     *
     * @param \QuestionnaireBundle\Entity\Question_questionnaire $questionnaire
     */
    public function removeQuestionnaire(\QuestionnaireBundle\Entity\Question_questionnaire $questionnaire)
    {
        $this->questionnaire->removeElement($questionnaire);
    }

    /**
     * Get questionnaire
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestionnaire()
    {
        return $this->questionnaire;
    }
}
