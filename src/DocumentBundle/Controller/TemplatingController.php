<?php

namespace DocumentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;

class TemplatingController extends Controller {

    private function dataLoader($file) {
        $finder = new Finder();
        $finder->files()->in(__DIR__ . '/../Resources/assets/')->name($file . '.json');
        foreach ($finder as $file) {
            $content = file_get_contents($file);
        }
        return json_decode($content);
    }

    public function noticeAction($id) {

        //NB: Les Objets ne sont pas des itérables donc on fait un transtypage pour transformer l'objet en tableau
        $vars['notice'] = (array) $this->dataLoader('notice');
        $vars['id'] = $id;
        return $this->render("DocumentBundle:Templating:notice.html.twig", $vars);
    }

}
