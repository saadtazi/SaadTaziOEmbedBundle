<?php

namespace SaadTazi\Bundle\OEmbedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DemoController extends Controller
{
    
    public function demoAction()
    {
        $oembed = $this->get('saadtazi_oembed');
        $oembedResponse = $oembed->get('http://www.youtube.com/watch?v=REy3wCFjqZo');
        var_dump($oembedResponse);
        return $this->render('SaadTaziOEmbedBundle:Demo:demo.html.twig', array('oembed' => $oembedResponse));
    }
}
