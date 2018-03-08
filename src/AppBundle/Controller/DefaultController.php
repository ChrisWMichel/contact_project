<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }


    /**
     * @Route("/pdf", name="create_pdf")
     */
    public function pdfAction()
    {
        // Make a pdf from a twig page

        $snappy = $this->get("knp_snappy.pdf");

        $users = $this->getDoctrine()->getRepository('AppBundle:Users')->findAll();

        $html = $this->renderView("default/pdf.html.twig", [
          "title" => "All Contacts",
          'users' => $users
        ]);

        // $html = "<h1>Hello Download PDF</h1>";

        $filename = 'pdf_contacts';

        return new Response(
          $snappy->getOutputFromHtml($html),
          200,
          [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename. '.pdf"'
          ]
        );
    }

}
