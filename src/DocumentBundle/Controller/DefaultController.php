<?php

namespace DocumentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DocumentBundle:Default:index.html.twig');
    }
    
    public function varsAction()
    {
        return $this->render('DocumentBundle:Default:vars.html.twig');
    }
    
    public function messageAction()
    {
        return $this->render('DocumentBundle:Default:message.html.twig');
    }
    
    public function diviseAction()
    {
        return $this->render('DocumentBundle:Default:message.html.twig');
    }
}
