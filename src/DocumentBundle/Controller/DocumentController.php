<?php

namespace DocumentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DocumentController extends Controller {

    public function messageAction() {
        //dump('test');

        $response = new Response();
        $response->setExpires(new \DateTime('2020-10-05'));
        $response->headers->set('Content-Type', 'text/html');
        $response->setContent('<h1>Salut nes</h1>');

        return $response;
    }

    public function diviseAction(Request $request, $nombre, $diviseur) {

        $interactive = $request->query->get('interactive');

        $page_entete = "<html><body>";
        $page_pied = "</body></html>";
        if ($nombre % $diviseur == 0) {
            $titre = "Vrai";
            $message = $nombre . " est divisible par" . $diviseur;
        } else {
            $titre = "Faux";
            $message = "Le reste de la division est :" . $nombre % $diviseur;
        }

        if ($interactive == 'oui') {
            $html = $page_entete . "<input type='text' placeholder='Quel est le reste ?'/>" . $page_pied;
        } else {
            $html = $page_entete . "<h1>" . $titre . "</h1>" . "<p>" . $message . "</p>" . $page_pied;
        }

        $response = new Response();
        $response->setContent($html);

        return $response;
    }

    public function requestParametersAction(Request $request) {
        $vars['accept'] = $request->headers->get('Accept');
        $vars['chacheControl'] = $request->headers->get('Cahce-control');
        $vars['userAgent'] = $request->headers->get('User-Agent');
        $vars['methode'] = $request->headers->get('Methode');
        $vars['host'] = $request->headers->get('Host');
        $vars['client'] = $request->headers->get('Client');
        $vars['userIp'] = $request->headers->get('User-IP');
        $vars['cookie'] = $request->headers->get('Cookie');

        return $this->render("DocumentBundle:Default:requestParameters.html.twig", array('vars' => $vars));
    }

    public function redirectAction($url) {

        if (strpos($url, '.') === false) {
            $url = $this->generateUrl('homepage');
        } else {
            $url = 'https://' . $url;
        }
        return $this->redirect($url, 301);

    }
    
    
    public function redirectToRouteAction() {
        
        return $this->redirectToRoute('document_parameters');
    }
    
    public function forwardDiviseAction($nombre) {
        
        return $this->forward("DocumentBundle:Document:divise", 
                array(
                    'nombre'=>$nombre,
                    'diviseur'=> 2
                ));
    }
    
    public function error403Action() {

        $response = new Response();
        $response->setStatusCode(Response::HTTP_FORBIDDEN);
        $response->setContent("Vous n'avez pas le droit");
        return $response;
    }
    
    public function errorAction($route) {
        
        if($route == 'homepage'){
            return $this->redirect($this->generateUrl('document_message'),301);
        }else{
            throw $this->createNotFoundException('Page non trouvé');
        }
    }
    
        /**
         * 
         * use parameters const from parameters.yml
         * 
         */
    
        public function parametersDiviseAction($nombre) {
            $diviseur =$this->getParameter('math')['diviseur'];
            return $this->forward("DocumentBundle:Document:divise", 
                array(
                    'nombre'=>$nombre,
                    'diviseur'=> $diviseur
                ));
        }

}
