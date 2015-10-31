<?php

namespace QuestionnaireBundle\Twig\Extension;

class QuestionnaireTwigExtension extends \Twig_Extension {

    public function getName() {
        return 'tuyautwigext';
    }

    public function getFilters() {
        return array(
            'reverse_color' => new \Twig_Filter_Method($this, 'invertColor'),
        );
    }

    public function invertColor() {

        echo "j'inverse les couleurs";
    }
}