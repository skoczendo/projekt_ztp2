<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{
    /**
     * Index action.
     *
     * @Route(
     *     "/",
     *     name="home_index",
     * )
     */
    public function indexAction()
    {
        return $this->render('home/index.html.twig');
    }
}
