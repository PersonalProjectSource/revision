<?php


namespace QuestionnaireBundle\Services;


use Symfony\Component\HttpFoundation\Request;
use QuestionnaireBundle\Managers\QuestionnaireManager;
use Symfony\Component\Security\Core\SecurityContext;


class QuestionnaireServices {

    private $questionManager;
    private $security;

    /**
     * @param QuestionnaireManager $manager
     * @param SecurityContext $security
     */
    public function __construct (QuestionnaireManager $manager, SecurityContext $security) {
        $this->questionManager = $manager;
        $this->security = $security;
    }

    /**
     * Return questionnaireManager
     */
    public function getQuestionManager() {
        return $this->questionManager;
    }

}