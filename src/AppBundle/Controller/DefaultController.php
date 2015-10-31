<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $context = $this->container->get('security.context');

        if ($context->isGranted('ROLE_SUPER_ADMIN')) {
            var_dump("redirect super admin");
            $redirectRoot = 'default/index.html.twig';
        }
        elseif ($context->isGranted('ROLE_ADMIN')) {
//            dump($this->generateUrl('admin_index'));die;
            return $this->redirect($this->generateUrl('admin_index'));
        }
        elseif ($context->isGranted('ROLE_USER')) {
            $redirectRoot = 'default/index.html.twig';
        }
        else {
            die('else');
            $redirectRoot = 'default/index';
        }


        return $this->render($redirectRoot, array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
//        return $this->render($redirectRoot, array(
//            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
//        ));
    }
}
