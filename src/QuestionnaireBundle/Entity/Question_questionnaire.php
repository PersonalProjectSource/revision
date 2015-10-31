<?php

namespace QuestionnaireBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * question_questionnaire
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="QuestionnaireBundle\Entity\Repositories\Question_questionnaireRepository")
 */
class Question_questionnaire
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
     * @ORM\ManyToOne(targetEntity="Question",  inversedBy="questionnaire", cascade={"all"})
     */
    private $question;

    /**
     * @ORM\ManyToOne(targetEntity="Questionnaire",  inversedBy="question", cascade={"all"})
     */
    private $questionnaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

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
     * Set date
     *
     * @param \DateTime $date
     * @return question_questionnaire
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set questions
     *
     * @param \QuestionnaireBundle\Entity\Question $questions
     * @return Question_questionnaire
     */
    public function setQuestions(\QuestionnaireBundle\Entity\Question $questions = null)
    {
//        $questions->addQuestionnaire($this);
        $this->question = $questions;

        return $this;
    }

    /**
     * Get questions
     *
     * @return \QuestionnaireBundle\Entity\Question 
     */
    public function getQuestions()
    {
        return $this->question;
    }

    /**
     * Set questionnaires
     *
     * @param \QuestionnaireBundle\Entity\Questionnaire $questionnaires
     * @return Question_questionnaire
     */
    public function setQuestionnaires(\QuestionnaireBundle\Entity\Questionnaire $questionnaires = null)
    {
//        $questionnaires->addQuestion($this);
        $this->questionnaire = $questionnaires;

        return $this;
    }

    /**
     * Get questionnaires
     *
     * @return \QuestionnaireBundle\Entity\Questionnaire 
     */
    public function getQuestionnaires()
    {
        return $this->questionnaire;
    }
}
