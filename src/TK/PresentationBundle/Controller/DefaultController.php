<?php

namespace TK\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PresentationBundle:Default:index.html.twig', array('name' => $name));
    }
}
