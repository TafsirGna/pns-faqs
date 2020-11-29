<?php

namespace App\Controller;

use App\Entity\Faq;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        ]);
    }

    /**
     * @Route("/dashboard/faq/new", name="dashboard_new_faq")
     */
    public function newFaq(): Response
    {

        

        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'faqs'  =>  $faqs,
        ]);
    }
}
