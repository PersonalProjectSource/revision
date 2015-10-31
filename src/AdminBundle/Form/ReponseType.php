<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;
use QuestionnaireBundle\Entity\Question;

use UserBundle\Entity\User;

class ReponseType extends AbstractType
{

    private $currentUser;
    private $question;

//    public function __construct(User $user, Question $question = null) {
//        $this->question = $question;
//        $this->currentUser = $user;
//    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('vrai', 'checkbox')
            ->add('actif')
            ->add('checkReponse', 'checkbox', array(
                        'attr' => array('class' => 'input-group-addon'),
                        'label' => ' ',
                        'mapped' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'QuestionnaireBundle\Entity\Reponse'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'questionnairebundle_reponse';
    }
}
