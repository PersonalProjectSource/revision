<?php

namespace QuestionnaireBundle\Controller;

use QuestionnaireBundle\Entity\Question_questionnaire;
use QuestionnaireBundle\Entity\Questionnaire;
use QuestionnaireBundle\Entity\Reponse;
use QuestionnaireBundle\Form\QuestionFrontType;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use QuestionnaireBundle\Entity\Question;
use QuestionnaireBundle\Form\QuestionType;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Question controller.
 *
 * @Route("/question")
 */
class QuestionController extends Controller
{

    /**
     * Define the maximum question number.
     */
    const MAX_QUESTION_NUMBER = "questionnaire.questionaire_service";

    /**
     * Name of questionnaire service.
     */
    const QUESTIONNAIRE_SERVICE_NAME = "questionnaire.questionaire_service";

    /**
     * Donne l'acces au questionnaire.
     *
     * @Route("/questionnaire/access/{id}", name="questionnaire_access")
     * @Method({"GET","POST"})
     * @Template("QuestionnaireBundle:Question:show.html.twig")
     * @param Request $request
     * @param $id
     * @return array
     */
    public function questionnaireAccess(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $parametersBag = $request->request;
        $randomQuestion = $this->getRamdomQuestion($id);
        $form = $this->createFrontForm($randomQuestion);
        if ($request->isMethod('post')) {
            $questionnaire = $this->container->get('questionnaire.questionnaire_manager')
                                             ->manageQuestionnaireContinuance($parametersBag);
            // ---- Termine le questionnaire après la 20e question. ----
            if (self::MAX_QUESTION_NUMBER <= $questionnaire->getNbQuestion()) {
                return $this->redirect($this->generateUrl(('questionnaire_score')));
            }
        } else {
            $questionnaire = new Questionnaire();
            $questionnaire->setActif(true);
            $currentUser = $this->container->get('security.context')->getToken()->getUser();
            $questionnaire->setUser($currentUser);
            $em->persist($questionnaire);
        }
        $em->flush();

        return array(
            'questionnaire_id' => $questionnaire->getId(),
            'nb_question' => $questionnaire->getNbQuestion(),
            'question_id' => $randomQuestion->getId(),
            'categorie_id' => $id,
            'form' => $form->createView(),
        );
    }

    /**
     * Affiche les scores.
     *
     * @Route("/questionnaire/score/", name="questionnaire_score")
     * @Method({"GET","POST"})
     * @Template("QuestionnaireBundle:Question:score.html.twig")
     */
    public function displayScoresAction()
    {
        return array();
    }


    /**
     * Return a ramdom question from database.
     *
     * @param $idCat
     * @return mixed
     */
    private function getRamdomQuestion($idCat)
    {
        $em = $this->getDoctrine()->getManager();
        //TODO utiliser les paramsConverter ;)
        $entities = $em->getRepository('QuestionnaireBundle:Question')
                             ->findBy(array('categorie' => $idCat));
        if (!$entities) {
            throw new Exception('Aucune questions enregistrées en base.');
        }
        $index = $this->container
                        ->get('questionnaire.questionnaire_manager')
                         ->getRandomIndexQuestion($entities);

        return $entities[$index];
    }

    /**
     * @param $question
     * @return \Symfony\Component\Form\Form
     */
    public function createFrontForm($question)
    {
        $questionService = $this->container->get('questionnaire.questionnaire_type');
        $form = $this->createForm($questionService, $question, array(
//            'action' => $this->generateUrl('controller_response'),
            'method' => 'POST',
            'attr' => array(
                'id' => 'target'
            )
        ));
        $form->add('Question_suivante', 'submit', array(
            'label' => 'Question suivante',
            'attr' => array(
                'class' => 'btn btn-success',
            )
        ));

        return $form;
    }
}
