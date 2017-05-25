<?php
/**
 * Contestant controller.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Contestant;
use AppBundle\Form\ContestantType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;

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
     * @param integer $page Current page number
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
    public function indexAction($page)
    {
        $contestants = $this->get('app.repository.contestant')->findAllPaginated($page);

        return $this->render(
            'contestant/index.html.twig',
            ['contestants' => $contestants]
        );
    }

    /**
     * Index by sex action.
     *
     * @param integer $page Current page number
     *
     * @param string $sex Sex
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
            ['contestants' => $contestants]
        );
    }



    /**
     * View action.
     *
     * @return \Symfony\Component\HttpFoundation\Response Response
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
            return $this->render(
                'contestant/view.html.twig',
                [
                    'contestant' => $contestant,
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
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
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
    public function editAction(Request $request, Contestant $contestant){
        $form = $this->createForm(ContestantType::class, $contestant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.contestant')->save($contestant);
            $this->addFlash('success', 'message.created_successfully');

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
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
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
    public function deleteAction(Request $request,Contestant $contestant){
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
