<?php
/**
 * Competition controller.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Competition;
use AppBundle\Form\CompetitionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Valid;

/**
 * Class CompetitionController.
 *
 * @package AppBundle\Controller
 *
 * @Route("/competition")
 */
class CompetitionController extends Controller
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
     *     name="competition_index",
     * )
     * @Route(
     *     "/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="competition_index_paginated",
     * )
     * @Method("GET")
     */
    public function indexAction($page)
    {
        $competitions = $this->get('app.repository.competition')->findAllPaginated($page);

        return $this->render(
            'competition/index.html.twig',
            ['competitions' => $competitions]
        );
    }

    /**
     * View action.
     *
     * @return \Symfony\Component\HttpFoundation\Response Response
     *
     * @Route(
     *     "/view/{id}",
     *     name="competition_view"
     * )
     */
    public function viewAction($id)
    {
        $competition = $this->get('app.repository.competition')->findOneById($id);
        if (!$competition) {
            throw $this->createNotFoundException(
                'No competition found for id '.$id
            );
        } else {
            $scores = $this->get('app.repository.score')->findByCompetition($id);
            return $this->render(
                'competition/view.html.twig',
                [
                    'competition' => $competition,
                    'scores' => $scores,
                    'id' => $id
                ]
            );
    }
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
     *     name="competition_add",
     * )
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
    {
        $competition = new Competition();
        $form = $this->createForm(CompetitionType::class, $competition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.competition')->save($competition);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('competition_index');
        }

        return $this->render(
            'competition/add.html.twig',
            [
                'competition' => $competition,
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
     *     name="competition_edit",
     *     requirements={"page": "[1-9]\d*"},
     * )
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Competition $competition){
        $form = $this->createForm(CompetitionType::class, $competition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.competition')->save($competition);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('competition_index');
        }

        return $this->render(
            'competition/edit.html.twig',
            [
                'competition' => $competition,
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
     *     name="competition_delete",
     *     requirements={"page": "[1-9]\d*"},
     * )
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request,Competition $competition){
        $errors = $this->get('validator')->validateValue(
            $competition,
            new Valid(),
            'competitions-delete'
        );

        if ($errors->count()) {
            $this->addFlash('warning', 'message.cant_delete');
            return $this->redirectToRoute('c_index');
        }

        $form = $this->createForm(FormType::class, $competition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.competition')->delete($competition);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('competition_index');
        }

        return $this->render(
            'competition/delete.html.twig',
            [
                'competition' => $competition,
                'form' => $form->createView(),
            ]
        );
    }
}