<?php
/**
 * Home controller.
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class DefaultController.
 *
 * @package AppBundle\Controller
 *
 * @Route("/")
 */
class HomeController extends Controller
{
    /**
     * Index action.
     *
     * @Route(
     *     "/",
     *     name="home_index",
     * )
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     */
    public function indexAction()
    {
        return $this->render('home/index.html.twig');
    }
}
