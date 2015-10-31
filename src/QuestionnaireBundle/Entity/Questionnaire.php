<?php

namespace QuestionnaireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Questionnaire
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Questionnaire
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
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="questionnaires")
     */
    private $user;

    /**
     * @ORM\Column(name="score", type="integer")
     */
    private $score;

//    /**
//     * @ORM\ManyToMany(targetEntity="Question",  mappedBy="questionnaires", cascade={"persist", "remove"})
//     */
//    private $questions;

    /**
     *  @ORM\OneToMany(targetEntity="Question_questionnaire",  mappedBy="questionnaires", cascade={"all"})
     */
    private $question;


    /**
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean")
     */
    private $actif;

    /**
     * @var string
     *
     * @ORM\Column(name="nb_question", type="integer", nullable=true)
     */
    private $nbQuestion;


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
     * Set actif
     *
     * @param boolean $actif
     * @return Questionnaire
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
        $this->score = 0;
        $this->nbQuestion = 0;
    }



    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     * @return Questionnaire
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set score
     *
     * @param \QuestionnaireBundle\Entity\Score $score
     * @return Questionnaire
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return \QuestionnaireBundle\Entity\Score 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set nbQuestion
     *
     * @param integer $nbQuestion
     * @return Questionnaire
     */
    public function setNbQuestion($nbQuestion)
    {
        $this->nbQuestion = $nbQuestion;

        return $this;
    }

    /**
     * Get nbQuestion
     *
     * @return integer 
     */
    public function getNbQuestion()
    {
        return $this->nbQuestion;
    }

    /**
     * Add question
     *
     * @param \QuestionnaireBundle\Entity\Question_questionnaire $question
     * @return Questionnaire
     */
    public function addQuestion(\QuestionnaireBundle\Entity\Question $question)
    {
        $link = new Question_questionnaire();
//        dump(new DateTime());

        $link->setDate(new \DateTime('NOW'));

        $link
            ->setQuestions($question)
            ->setQuestionnaires($this);

        $question->addQuestionnaire($link);
        $this->question[] = $link;

        return $this;
    }

    /**
     * Remove question
     *
     * @param \QuestionnaireBundle\Entity\Question_questionnaire $question
     */
    public function removeQuestion(\QuestionnaireBundle\Entity\Question_questionnaire $question)
    {
        $this->question->removeElement($question);
    }

    /**
     * Get question
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestion()
    {
        return $this->question;
    }
}
