<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Entity\TypeDemande;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CertificatGeneratorController extends AbstractController
{
    /**
     * @Route("/certificat/{id}", name="certificat_generator")
     */
    public function generatePdf(Demande $demande): Response
    {

        //Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $typeDemande = $demande->getType()->getLibele();
        if($typeDemande == TypeDemande::TYPE_RELEVE){
            $html = $this->renderView('certificat_generator/releve/index.html.twig', [
                'demande' => $demande
            ]);

        }
        if($typeDemande == TypeDemande::TYPE_SCOLARITE){
            $html = $this->renderView('certificat_generator/scolarite/index.html.twig', [
                'demande' => $demande
            ]);
        }
        if($typeDemande == TypeDemande::TYPE_STAGE){
            $html = $this->renderView('certificat_generator/stage/index.html.twig', [
                'demande' => $demande
            ]);
        }

       

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
        }

}
