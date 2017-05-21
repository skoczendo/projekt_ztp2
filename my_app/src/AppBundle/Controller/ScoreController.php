<?php
/**
 * Score controller.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Competition;
use AppBundle\Entity\Score;
use AppBundle\Form\ScoreType;
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


    /**
     * Add action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/add",
     *     name="score_add",
     * )
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
    {
        $score = new Score();
        dump($score);
        $form = $this->createForm(ScoreType::class, $score);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.score')->save($score);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('competition_index');
        }

        return $this->render(
            'score/add.html.twig',
            [
                'score' => $score,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Edit action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/edit",
     *     name="score_edit",
     *     requirements={"page": "[1-9]\d*"},
     * )
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Score $score){
        $form = $this->createForm(ScoreType::class, $score);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.score')->save($score);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('competition_index');
        }

        return $this->render(
            'score/edit.html.twig',
            [
                'score' => $score,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/delete",
     *     name="score_delete",
     *     requirements={"page": "[1-9]\d*"},
     * )
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request,Score $score){
        $form = $this->createForm(FormType::class, $score);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.score')->delete($score);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('competition_index');
        }

        return $this->render(
            'score/delete.html.twig',
            [
                'score' => $score,
                'form' => $form->createView(),
            ]
        );
    }
}