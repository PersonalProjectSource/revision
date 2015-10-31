<?php

namespace QuestionnaireBundle\Services;

use Symfony\Component\Form\Extension\Core\Type\FormType;

class FormManagerService {

    private $formType;

    /**
     * @param FormType $formType
     * @param $httpMethod
     */
    public function __construct (FormType $formType) {

        $this->formType = $formType;
    }

    /**
     * Create formType according to httpMethod sent in param.
     *
     * @param String $httpMethod : definit sous forme de chaine la methode http a appliquer pour la creation du fomrulaire.
     */
    public function createForm($httpMethod) {


    }
}