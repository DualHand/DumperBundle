<?php

namespace DualHand\DumperBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DualHandDumperBundle:Default:index.html.twig');
    }
}
