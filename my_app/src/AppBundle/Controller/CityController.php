<?php
/**
 * School controller.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CityController.
 *
 * @package AppBundle\Controller
 *
 * @Route("/city")
 */
class CityController extends Controller
{
    /**
     * Index action.
     *
     * @param integer $page Current page number
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/",
     *     defaults={"page": 1},
     *     name="city_index",
     * )
     * @Route(
     *     "/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="city_index_paginated",
     * )
     * @Method("GET")
     */
    public function indexAction()
    {
        $cities = $this->get('app.repository.city')->findAll();

        return $this->render(
            'city/index.html.twig',
            ['cities' => $cities]
        );
    }
}