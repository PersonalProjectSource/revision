<?php

namespace QuestionnaireBundle\Managers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use QuestionnaireBundle\Entity\Questionnaire;
use QuestionnaireBundle\Entity\Question;
use Symfony\Component\Validator\Validator\RecursiveValidator as Validator;

class QuestionnaireManager {

    /**
     * @var Request $request
     */
    private $request;

    /**
     * @var Questionnaire $questionnaireRepository
     */
    private $em;

    /**
     * @var Validator $validator
     */
    private $validator;

    /**
     * @var SecurityContextInterface $context
     */
    private $context;

    /**
     * @var User $currentUser
     */
    private $currentUser;


    /**
     * Dependencies injections
     *
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Validator|ValidatorInterface $validator
     * @param SecurityContextInterface $context
     * @internal param Questionnaire $questionnaireRepository
     */
    public function __construct (
        Request $request,
        EntityManagerInterface $em,
        ValidatorInterface $validator,
        SecurityContextInterface $context
    ) {
        $this->request = $request;
        $this->em = $em;
        $this->validator = $validator;
        $this->context = $context;
        $this->currentUser = $context->getToken()->getUser();
    }

    /**
     * Manage and check questionnaire responses.
     * Return false if one question is bad.
     *
     * @param Request $request
     * @param $entity
     * @return bool
     * @throws \ErrorException
     */
    public function questionnaireHandler(Request $request, $entity) {

        $responses = $request->request->get('reponses');
        if (!$this->validator->validate($entity)->count()) {
            $responseQuality =  $this->areResponsesCorrect($responses);
        }
        else {
            throw new \ErrorException("Les données envoyées semblent compromises");
        }

        return $responseQuality;
    }

    /**
     * Check if responses array containts one false value.
     *
     * @param $responses
     * @return bool
     */
    public function areResponsesCorrect ($responses) {
        return (null == $responses) ? false : !in_array(false, $responses);
    }

    /**
     * Generate an random index inside entities number perimeter.
     *
     * @param $entities
     * @return int
     */
    public function getRandomIndexQuestion($entities) {
        $index = rand(0, count($entities) - 1);
        return $index;
    }

    /**
     * Check if response is right or wrong.
     *
     * @param Questionnaire $questionnaire
     * @param Question $question
     * @param $reponses
     * @return Questionnaire
     */
    public function manageAnswer(Questionnaire $questionnaire, Question $question, $reponses)
    {
        $questionnaire->addQuestion($question);
        if ($this->areResponsesCorrect($reponses)) {
            $newScore = $questionnaire->getScore() + 1;
            $questionnaire->setScore($newScore);
        }
        $questionnaire->setNbQuestion($questionnaire->getNbQuestion() + 1);

        return $questionnaire;
    }

    /**
     * Manage continuation or interuption of questionnary
     *
     * @param $parametersBag
     * @return object|Questionnaire
     * @throws \Exception
     */
    public function manageQuestionnaireContinuance($parametersBag)
    {
        if ($parametersBag->get('questionnaire_id')) {
            $questionnaire = $this->em->getRepository("QuestionnaireBundle:Questionnaire")
                                      ->find($parametersBag->get('questionnaire_id'));
            if (empty($questionnaire)) {
                throw new \Exception("Aucun questionnaire n'a pu être trouvé en base.");
            }
        } else {
            throw new \Exception("Aucun questionnaire n'est associé à cette question.");
        }
        $question = $this->em->getRepository("QuestionnaireBundle:Question")
                             ->findOneById($parametersBag->get('question_id'));
        if (empty($question)) {
            throw new \Exception("Aucune question n'a pu être trouvée en base.");
        }
        // ---- Vérifie si la réponse envoyée est bonne ----
        $questionnaire = $this->manageAnswer($questionnaire, $question, $parametersBag->get('reponses'));

        return $questionnaire;
    }

}