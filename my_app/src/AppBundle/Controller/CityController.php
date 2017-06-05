<?php
/**
 * City controller.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\City;
use AppBundle\Form\CityType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Valid;

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
    public function indexAction($page)
    {
        $cities = $this->get('app.repository.city')->findAllPaginated($page);

        return $this->render(
            'city/index.html.twig',
            ['cities' => $cities]
        );
    }

    /**
     * View action.
     *
     * @return \Symfony\Component\HttpFoundation\Response Response
     *
     * @Route(
     *     "/view/{id}",
     *     name="city_view"
     * )
     */
    public function viewAction($id)
    {
        $city = $this->get('app.repository.city')->findOneById($id);
        if (!$city) {
            throw $this->createNotFoundException(
                'No city found for id '.$id
            );
        } else {
            return $this->render(
                'city/view.html.twig',
                [
                    'city' => $city,
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
     *     name="city_add",
     * )
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
    {
        $city = new City();
        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.city')->save($city);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('city_index');
        }

        return $this->render(
            'city/add.html.twig',
            [
                'city' => $city,
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
     *     name="city_edit",
     *     requirements={"page": "[1-9]\d*"},
     * )
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, City $city){
        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.city')->save($city);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('city_index');
        }

        return $this->render(
            'city/edit.html.twig',
            [
                'city' => $city,
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
     *     name="city_delete",
     *     requirements={"page": "[1-9]\d*"},
     * )
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request,City $city){


        $errors = $this->get('validator')->validateValue(
            $city,
            new Valid(),
            'cities-delete'
        );

        dump($errors->violations);



        if ($errors) {
            $this->addFlash('warning', 'message.error');
            return $this->redirectToRoute('city_index');
        }

        $form = $this->createForm(FormType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.city')->delete($city);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('city_index');
        }

        return $this->render(
            'city/delete.html.twig',
            [
                'city' => $city,
                'form' => $form->createView(),
            ]
        );
    }
}