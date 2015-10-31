<?php

namespace AdminBundle\Form;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;
use QuestionnaireBundle\Entity\Question;


class QuestionType extends AbstractType
{

    private $user;
    private $question;
    private $context;

    public function __construct() {
    }
//    public function __construct(Request $request, SecurityContext $context) {
////        $this->question = $question;
//        $this->question = new Question();
//        $this->context = $context;
//        $this->user = $this->context->getToken()->getUser();
//    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('categorie', 'entity', array(
                'class' => 'QuestionnaireBundle:Categorie',
                'property' => 'nomCat'
            ))
//            ->add('reponses', 'collection', array(
//                'type' => new ReponseType($this->user,$this->question),
//                'allow_add' => true,
//                'by_reference' => false,
//            ))
            ->add('reponses', new ReponseType($this->user,$this->question))
        ;
    }

    /**
     * Affiches une checkbox vierge pour les questions devant etre montrées au client de l'épreuve.
     *
     * @param FormEvent $event
     */
    public function displayCat(FormEvent $event) {

        $question = $event->getData();
        $form = $event->getForm();

        if ($this->user && $this->user->getRoles()[0] == 'ROLE_USER') {
//            $form->add('categorie', 'entity', array(
//                'class' => 'QuestionnaireBundle:Categorie',
//                'property' => 'nomCat'
//            ));
        }
        else if ($this->user && $this->user->getRoles()[0] == 'ROLE_ADMIN') {
            $form->add('categorie', 'entity', array(
                'class' => 'QuestionnaireBundle:Categorie',
                'property' => 'nomCat'
            ));
            $form->add('actif');

        }
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'QuestionnaireBundle\Entity\Question'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'questionnairebundle_question';
    }
}
