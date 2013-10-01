<?php

namespace Wj\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('WjSecurityBundle:Default:index.html.twig', array('name' => $name));
    }
}
