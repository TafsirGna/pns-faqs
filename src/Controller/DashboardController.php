<?php

namespace App\Controller;

use App\Entity\Faq;
use App\Entity\Platform;
use App\Form\NewFaqType;
use App\Form\NewPlatformType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard", name="dashboard")
 */

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="_index")
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
     * @Route("/platforms", name="_platforms")
     */
    public function listPlatforms(): Response
    {

        $platforms = $this->getDoctrine()
                     ->getManager()
                     ->getRepository(Platform::class)
                     ->findAll();

        return $this->render('dashboard/platforms/list.html.twig', [
            'controller_name' => 'DashboardController',
            'platforms'  =>  $platforms,
            'selected_menu' =>  "platforms",
        ]);
    }

    /**
     * @Route("/platform/new", name="_new_platform")
     */
    public function newPlatform(Request $request): Response
    {

        // just setup a fresh $task object (remove the example data)
        $platform = new Platform();

        $form = $this->createForm(NewPlatformType::class, $platform);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $platform = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($platform);
            $entityManager->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('dashboard/platforms/new.html.twig', [
            'controller_name' => 'DashboardController',
            'selected_menu' =>  "platforms",
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/platform/edit/{id}", name="_platform_edition")
     */
    public function editPlatform(Request $request, Platform $platform): Response
    {

        // just setup a fresh $task object (remove the example data)
        // $platform = new Platform();

        $form = $this->createForm(NewPlatformType::class, $platform);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $platform = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($platform);
            $entityManager->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('dashboard/platforms/new.html.twig', [
            'controller_name' => 'DashboardController',
            'selected_menu' =>  "platforms",
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/faq/new", name="_new_faq")
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

            return $this->redirectToRoute('dashboard_index');
        }

        return $this->render('dashboard/faqs/new.html.twig', [
            'controller_name' => 'DashboardController',
            'selected_menu' =>  "faqs",
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/faq/delete/{id}", name="_faq_deletion")
     */
    public function deleteFaq(Request $request, Faq $faq): Response
    {

        $em = $this->getDoctrine()
                    ->getManager();

        try {
            //code...
            $em->remove($faq);
            $em->flush();
        } catch (\Throwable $th) {
            throw $th;
        }

        return $this->redirectToRoute("dashboard");
    }

    /**
     * @Route("/platform/delete/{id}", name="_platform_deletion")
     */
    public function deletePlatform(Request $request, Platform $platform): Response
    {

        $em = $this->getDoctrine()
                    ->getManager();

        try {
            //code...
            $em->remove($platform);
            $em->flush();
        } catch (\Throwable $th) {
            throw $th;
        }

        return $this->redirectToRoute("dashboard");
    }
}
