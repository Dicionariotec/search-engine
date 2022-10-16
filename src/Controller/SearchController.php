<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(Request $request): Response
    {
        $defaultData = ['message' => 'Digite o que você procura'];
        $form = $this->createFormBuilder($defaultData)
            ->add('keyword', TextType::class, [
                'label' => 'Digite aqui para pesquisar',
                'attr' => [
                    'placeholder' => 'Digite aqui para pesquisar',
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
            ])
            ->add('submit', SubmitType::class, ['label' => 'Pesquisar'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
        }

        return $this->renderForm('search/search.html.twig', [
            'form' => $form,
        ]);
    }

}
