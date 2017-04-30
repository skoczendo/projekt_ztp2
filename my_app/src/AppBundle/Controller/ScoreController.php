<?php
/**
 * Score controller.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ScoreController.
 *
 * @package AppBundle\Controller
 *
 * @Route("/score")
 */
class ScoreController extends Controller
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
     *     name="score_index",
     * )
     * @Route(
     *     "/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="score_index_paginated",
     * )
     * @Method("GET")
     */
    public function indexAction()
    {
        $scores = $this->get('app.repository.score')->findAll();

        return $this->render(
            'score/index.html.twig',
            ['scores' => $scores]
        );
    }
}