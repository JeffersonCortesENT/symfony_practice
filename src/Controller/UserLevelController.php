<?php

namespace App\Controller;

use App\Entity\UserLevel;
use App\Form\UserLevelType;
use App\Repository\UserLevelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/level")
 */
class UserLevelController extends AbstractController
{
    /**
     * @Route("/", name="app_user_level_index", methods={"GET"})
     */
    public function index(UserLevelRepository $userLevelRepository): Response
    {
        return $this->render('user_level/index.html.twig', [
            'user_levels' => $userLevelRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_user_level_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UserLevelRepository $userLevelRepository): Response
    {
        $userLevel = new UserLevel();
        $form = $this->createForm(UserLevelType::class, $userLevel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userLevelRepository->add($userLevel);
            return $this->redirectToRoute('app_user_level_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_level/new.html.twig', [
            'user_level' => $userLevel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_level_show", methods={"GET"})
     */
    public function show(UserLevel $userLevel): Response
    {
        return $this->render('user_level/show.html.twig', [
            'user_level' => $userLevel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_user_level_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, UserLevel $userLevel, UserLevelRepository $userLevelRepository): Response
    {
        $form = $this->createForm(UserLevelType::class, $userLevel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userLevelRepository->add($userLevel);
            return $this->redirectToRoute('app_user_level_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_level/edit.html.twig', [
            'user_level' => $userLevel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_level_delete", methods={"POST"})
     */
    public function delete(Request $request, UserLevel $userLevel, UserLevelRepository $userLevelRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userLevel->getId(), $request->request->get('_token'))) {
            $userLevelRepository->remove($userLevel);
        }

        return $this->redirectToRoute('app_user_level_index', [], Response::HTTP_SEE_OTHER);
    }
}
