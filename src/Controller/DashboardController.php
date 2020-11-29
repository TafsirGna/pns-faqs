<?php

namespace App\Controller;

use App\Entity\Faq;
use App\Entity\Plateform;
use App\Form\NewFaqType;
use App\Form\NewPlateformType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(): Response
    {

        $faqs = $this->getDoctrine()
                     ->getManager()
                     ->getRepository(Faq::class)
                     ->findAll();

        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'faqs'  =>  $faqs,
            'selected_menu' =>  "faqs"
        ]);
    }

    /**
     * @Route("/dashboard/plateforms", name="dashboard_plateforms")
     */
    public function listPlateforms(): Response
    {

        $plateforms = $this->getDoctrine()
                     ->getManager()
                     ->getRepository(Plateform::class)
                     ->findAll();

        return $this->render('dashboard/plateforms/list.html.twig', [
            'controller_name' => 'DashboardController',
            'plateforms'  =>  $plateforms,
            'selected_menu' =>  "plateforms",
        ]);
    }

    /**
     * @Route("/dashboard/plateform/new", name="dashboard_new_plateform")
     */
    public function newPlateform(Request $request): Response
    {

        // just setup a fresh $task object (remove the example data)
        $plateform = new Plateform();

        $form = $this->createForm(NewPlateformType::class, $plateform);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $plateform = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('dashboard/plateforms/new.html.twig', [
            'controller_name' => 'DashboardController',
            'selected_menu' =>  "plateforms",
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/dashboard/faq/new", name="dashboard_new_faq")
     */
    public function newFaq(Request $request): Response
    {

        // just setup a fresh $task object (remove the example data)
        $faq = new Faq();

        $form = $this->createForm(NewFaqType::class, $faq);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            /**@var Faq */
            $faq = $form->getData();
            
            $faq->setCreatedAt(new \DateTime());
            $faq->setCreatedBy($this->getUser());

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($faq);
            $entityManager->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('dashboard/faqs/new.html.twig', [
            'controller_name' => 'DashboardController',
            'selected_menu' =>  "faqs",
            'form' => $form->createView(),
        ]);
    }
}
