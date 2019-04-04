<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="public_home")
     */
    //Homepage Function
    public function index()
    {
        $template = 'default/index.html.twig';
        $args = [];
        return $this->render($template, $args);
    }

    /**
     * @Route("/about", name="public_about")
     */
    //Contact Details Function
    public function about()
    {
        $template = 'default/about.html.twig';
        $args = [];
        return $this->render($template, $args);
    }
}
