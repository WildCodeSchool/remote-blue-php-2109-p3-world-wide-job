<?php

namespace App\Controller;

use App\Entity\Content;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="content_")
 */
class ContentController extends AbstractController
{
    /**
     * @Route("/{slug}", name="show", priority="-1")
     * @ParamConverter("Content", class="App\Entity\Content", options={"mapping": {"slug": "slug"}})
     */
    public function show(Content $content): Response
    {
        return $this->render(
            'content/index.html.twig',
            [
                'content' => $content
            ]
        );
    }
}
