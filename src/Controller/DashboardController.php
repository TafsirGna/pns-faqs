<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Faq;
use App\Entity\Platform;
use App\Entity\Question;
use App\Form\FaqEditionType;
use App\Form\NewAnswerType;
use App\Form\NewFaqType;
use App\Form\NewPlatformType;
use App\Form\NewQuestionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard", name="dashboard_")
 */

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="index")
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
     * @Route("/platforms", name="platforms")
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
     * @Route("/platform/new", name="new_platform")
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

            return $this->redirectToRoute('dashboard_index');
        }

        return $this->render('dashboard/platforms/new.html.twig', [
            'controller_name' => 'DashboardController',
            'selected_menu' =>  "platforms",
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/platform/edit/{id}", name="platform_edition")
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
     * @Route("/faq/new", name="new_faq")
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
     * @Route("/faq/edit/{id}", name="faq_edition")
     */
    public function editFaq(Request $request, Faq $faq): Response
    {

        // just setup a fresh $task object (remove the example data)
        // $faq = new Faq();

        $form = $this->createForm(FaqEditionType::class, $faq);

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
     * @Route("/faq/delete/{id}", name="faq_deletion")
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
     * @Route("/platform/delete/{id}", name="platform_deletion")
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
        return $this->redirectToRoute("dashboard_index");
    }

    /**
     * @Route("/faq/{id}/questions", name="faq_questions")
     */
    public function listFaqQuestions(Request $request, Faq $faq): Response
    {

        $questions = $this->getDoctrine()
                     ->getManager()
                     ->getRepository(Question::class)
                     ->findBy(["faq"    =>  $faq]);

        return $this->render('dashboard/questions/list.html.twig', [
            'controller_name' => 'DashboardController',
            'questions'  =>  $questions,
            'faq'   =>  $faq,
            'selected_menu' =>  "faqs",
        ]);
    }

    /**
     * @Route("/faq/{id}/question/new", name="faq_new_question")
     */
    public function newFaqQuestion(Request $request, Faq $faq): Response
    {

        // just setup a fresh $task object (remove the example data)
        $question = new Question();

        $form = $this->createForm(NewQuestionType::class, $question);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            /**@var Question */
            $question = $form->getData();
            
            $question->setCreatedAt(new \DateTime());
            $question->setFaq($faq);

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();

            return $this->redirectToRoute('dashboard_faq_questions', ["id"  =>  $faq->getId()]);
        }

        return $this->render('dashboard/questions/new.html.twig', [
            'controller_name' => 'DashboardController',
            'selected_menu' =>  "faqs",
            'faq'   =>  $faq,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/faq/question/edit/{id}", name="faq_question_edition")
     */
    public function editFaqQuestion(Request $request, Question $question): Response
    {

        // just setup a fresh $task object (remove the example data)
        // $question = new Question();

        $form = $this->createForm(NewQuestionType::class, $question);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            /**@var Question */
            $question = $form->getData();
            
            // $question->setCreatedAt(new \DateTime());
            // $question->setFaq($faq);

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();

            return $this->redirectToRoute('dashboard_faq_questions', ["id"  =>  $question->getFaq()->getId()]);
        }

        return $this->render('dashboard/questions/new.html.twig', [
            'controller_name' => 'DashboardController',
            'selected_menu' =>  "faqs",
            'faq'   =>  $question->getFaq(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/faq/question/{id}/answer/new", name="faq_question_new_answer")
     */
    public function newFaqQuestionAnswer(Request $request, Question $question): Response
    {

        // just setup a fresh $task object (remove the example data)
        $answer = new Answer();
        $answer->setQuestion($question);

        $form = $this->createForm(NewAnswerType::class, $answer);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            /**@var Answer */
            $answer = $form->getData();
            
            $answer->setCreatedAt(new \DateTime());
            // $question->setFaq($faq);

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($answer);
            $entityManager->flush();

            return $this->redirectToRoute('dashboard_faq_questions', ["id"  =>  $answer->getQuestion()->getFaq()->getId()]);
        }

        return $this->render('dashboard/answers/new.html.twig', [
            'controller_name' => 'DashboardController',
            'selected_menu' =>  "faqs",
            'faq'   =>  $answer->getQuestion()->getFaq(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/faq/question/answer/edit/{id}", name="faq_question_answer_edition")
     */
    public function editFaqQuestionAnswer(Request $request, Answer $answer): Response
    {

        // just setup a fresh $task object (remove the example data)
        // $question = new Question();

        $form = $this->createForm(NewAnswerType::class, $answer);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            /**@var Answer */
            $answer = $form->getData();
            
            // $question->setCreatedAt(new \DateTime());
            // $question->setFaq($faq);

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($answer);
            $entityManager->flush();

            return $this->redirectToRoute('dashboard_faq_questions', ["id"  =>  $answer->getQuestion()->getFaq()->getId()]);
        }

        return $this->render('dashboard/answers/new.html.twig', [
            'controller_name' => 'DashboardController',
            'selected_menu' =>  "faqs",
            'faq'   =>  $answer->getQuestion()->getFaq(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/faq/question/delete/{id}", name="faq_question_deletion")
     */
    public function deleteQuestion(Request $request, Question $question): Response
    {

        $em = $this->getDoctrine()
                    ->getManager();

        try {
            //code...
            $em->remove($question);
            $em->flush();
        } catch (\Throwable $th) {
            throw $th;
        }

        return $this->redirectToRoute("dashboard_faq_questions", ["id"  =>  $question->getFaq()->getId()]);
    }
}
