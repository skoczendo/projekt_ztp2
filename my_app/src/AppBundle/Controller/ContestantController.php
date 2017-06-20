<?php
/**
 * Contestant controller.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Contestant;
use AppBundle\Form\ContestantType;
use AppBundle\Form\SearchType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Valid;

/**
 * Class ContestantController.
 *
 * @package AppBundle\Controller
 *
 * @Route("/contestant")
 */
class ContestantController extends Controller
{
    /**
     * Index action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     * @param integer                                   $page    Current page number
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/",
     *     defaults={"page": 1},
     *     name="contestant_index",
     * )
     * @Route(
     *     "/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="contestant_index_paginated",
     * )
     * @Method("GET")
     */
    public function indexAction(Request $request, $page)
    {
        $contestants = $this->get('app.repository.contestant')->findAllPaginated($page);

        return $this->render(
            'contestant/index.html.twig',
            [
                'contestants' => $contestants,
                'sex' => 'open',
            ]
        );
    }

    /**
     * Index by sex action.
     *
     * @param integer $page Current page number
     * @param string  $sex  Sex
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/sex/{sex}",
     *     defaults={"page": 1},
     *     name="contestant_index_sex",
     * )
     * @Route(
     *     "/sex/{sex}/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="contestant_index_sex_paginated",
     * )
     * @Method("GET")
     */
    public function indexBySexAction($page, $sex)
    {
        $contestants = $this->get('app.repository.contestant')->findBySexPaginated($sex, $page);

        return $this->render(
            'contestant/index.html.twig',
            [
                'contestants' => $contestants,
                'sex' => $sex,
            ]
        );
    }


    /**
     * Index alphabetically-reversed action.
     *
     * @param integer $page Current page number
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/alphaReversed/",
     *     defaults={"page": 1},
     *     name="contestant_index_alpha_reversed",
     * )
     * @Route(
     *     "/alphaReversed/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="contestant_index_alpha_reversed_paginated",
     * )
     * @Method("GET")
     */
    public function indexOpenAlphabeticallyReversedAction($page)
    {
        $contestants = $this->get('app.repository.contestant')->findAllAphabeticallyReversedPaginated($page);

        return $this->render(
            'contestant/index.html.twig',
            [
                'contestants' => $contestants,
                'sex' => 'open',
            ]
        );
    }

    /**
     * Index by sex alphabetically-reversed action.
     *
     * @param string  $sex  Sex
     * @param integer $page Current page number
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/sex/{sex}/alphaReversed/",
     *     defaults={"page": 1},
     *     name="contestant_index_by_sex_alpha_reversed",
     * )
     * @Route(
     *     "/sex/{sex}/alphaReversed/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="contestant_index_by_sex_alpha_reversed_paginated",
     * )
     * @Method("GET")
     */
    public function indexBySexAlphabeticallyReversedAction($sex, $page)
    {
        $contestants = $this->get('app.repository.contestant')->findAllBySexAphabeticallyReversedPaginated($sex, $page);

        return $this->render(
            'contestant/index.html.twig',
            [
                'contestants' => $contestants,
                'sex' => $sex,
            ]
        );
    }


    /**
     * View action.
     *
     * @return \Symfony\Component\HttpFoundation\Response Response
     * @param integer $id Id
     *
     * @Route(
     *     "/view/{id}",
     *     name="contestant_view"
     * )
     */
    public function viewAction($id)
    {
        $contestant = $this->get('app.repository.contestant')->findOneById($id);
        if (!$contestant) {
            throw $this->createNotFoundException(
                'No contestant found for id '.$id
            );
        } else {
            $scores = $this->get('app.repository.score')->findByContestant($id);

            return $this->render(
                'contestant/view.html.twig',
                [
                    'contestant' => $contestant,
                    'scores' => $scores,
                    'id' => $id,
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
     *     name="contestant_add",
     * )
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
    {
        $contestant = new Contestant();
        $form = $this->createForm(ContestantType::class, $contestant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.contestant')->save($contestant);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('contestant_index');
        }

        return $this->render(
            'contestant/add.html.twig',
            [
                'contestant' => $contestant,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Edit action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP Request
     * @param Contestant                                $contestant Contestant
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/edit",
     *     name="contestant_edit",
     *     requirements={"page": "[1-9]\d*"},
     * )
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Contestant $contestant)
    {
        $form = $this->createForm(ContestantType::class, $contestant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.contestant')->save($contestant);
            $this->addFlash('success', 'message.edited_successfully');

            return $this->redirectToRoute('contestant_index');
        }

        return $this->render(
            'contestant/edit.html.twig',
            [
                'contestant' => $contestant,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request    HTTP Request
     * @param Contestant                                $contestant Contestant
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/delete",
     *     name="contestant_delete",
     *     requirements={"page": "[1-9]\d*"},
     * )
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request, Contestant $contestant)
    {
        $errors = $this->get('validator')->validateValue(
            $contestant,
            new Valid(),
            'contestants-delete'
        );

        if ($errors->count()) {
            $this->addFlash('warning', 'message.cant_delete');

            return $this->redirectToRoute('contestant_index');
        }

        $form = $this->createForm(FormType::class, $contestant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.contestant')->delete($contestant);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('contestant_index');
        }

        return $this->render(
            'contestant/delete.html.twig',
            [
                'contestant' => $contestant,
                'form' => $form->createView(),
            ]
        );
    }
}
