<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\SitemapCrawler;
use App\Form\SitemapCrawlerType;
use DOMDocument;
use DOMXPath;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class IndexController extends Controller
{


    public function crawl(Request $request)
    {
        $sitemapCrawler = new SitemapCrawler();

        $form = $this->createForm(SitemapCrawlerType::class, $sitemapCrawler);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Get datas.
            $datas = $form->getData();
            $urlSitemap = $datas->getUrl();
            $tag = $datas->getTag();
            $tagName = $datas->getTagName();
            $attribute = $datas->getAttribute();
            $name = $datas->getName();

            // Prepare data to export.
            $data = [];
            // Headings and rows.
            $headings = ['Url', 'Text'];
            $data[] = $headings;

            // Parsing.
            $html = new DOMDocument();
            @$html->loadHtmlFile($urlSitemap);
            $xpath = new DOMXPath( $html );
            $nodelist = $xpath->query($tag);
            foreach ($nodelist as $n){
                $arr = $n->getElementsByTagName($tagName);
                foreach($arr as $item) {
                    $url =  $item->getAttribute($attribute);
                    $text = trim(preg_replace("/[\r\n]+/", " ", $item->nodeValue));
                    $data[] = [
                        'url' => $url,
                        'text' => $text
                    ];
                }
            }

            // Generate an Excel file.
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->fromArray($data);

            $writer = new Xlsx($spreadsheet);

            ob_start();
            $writer->save('php://output');
            $excelContent = ob_get_contents();
            ob_end_clean();

            $response = new Response($excelContent, 200);
            $response->headers->set('Content-Type', 'application/octet-stream; charset=utf-8; application/force-download');
            $response->headers->set('Content-Disposition', 'attachment; filename="' . $name . '.xlsx"');

            return $response;
        }

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}