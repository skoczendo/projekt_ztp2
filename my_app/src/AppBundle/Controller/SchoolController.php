<?php
/**
 * School controller.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\School;
use AppBundle\Form\SchoolType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Valid;

/**
 * Class SchoolController.
 *
 * @package AppBundle\Controller
 *
 * @Route("/school")
 */
class SchoolController extends Controller
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
     *     name="school_index",
     * )
     * @Route(
     *     "/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="school_index_paginated",
     * )
     * @Method("GET")
     */
    public function indexAction($page)
    {
        $schools = $this->get('app.repository.school')->findAllPaginated($page);

        return $this->render(
            'school/index.html.twig',
            ['schools' => $schools]
        );
    }

    /**
     * View action.
     *
     * @return \Symfony\Component\HttpFoundation\Response Response
     *
     * @Route(
     *     "/view/{id}",
     *     name="school_view"
     * )
     */
    public function viewAction($id)
    {
        $school = $this->get('app.repository.school')->findOneById($id);
        if (!$school) {
            throw $this->createNotFoundException(
                'No school found for id '.$id
            );
        } else {

            $contestants = $this->get('app.repository.contestant')->findBySchool($id);
            return $this->render(
                'school/view.html.twig',
                [
                    'school' => $school,
                    'contestants' => $contestants,
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
     *     name="school_add",
     * )
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
    {
        $school = new School();
        $form = $this->createForm(SchoolType::class, $school);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.school')->save($school);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('school_index');
        }

        return $this->render(
            'school/add.html.twig',
            [
                'school' => $school,
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
     *     name="school_edit",
     *     requirements={"page": "[1-9]\d*"},
     * )
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, School $school){
        $form = $this->createForm(SchoolType::class, $school);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.school')->save($school);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('school_index');
        }

        return $this->render(
            'school/edit.html.twig',
            [
                'school' => $school,
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
     *     name="school_delete",
     *     requirements={"page": "[1-9]\d*"},
     * )
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request,School $school){

        $errors = $this->get('validator')->validateValue(
            $school,
            new Valid(),
            'schools-delete'
        );

        if ($errors->count()) {
            $this->addFlash('warning', 'message.cant_delete');
            return $this->redirectToRoute('school_index');
        }

        $form = $this->createForm(FormType::class, $school);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.school')->delete($school);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('school_index');
        }

        return $this->render(
            'school/delete.html.twig',
            [
                'school' => $school,
                'form' => $form->createView(),
            ]
        );
    }

}