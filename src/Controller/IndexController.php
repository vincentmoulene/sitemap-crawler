<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\SitemapCrawler;
use App\Form\SitemapCrawlerType;
use DOMDocument;
use DOMXPath;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class IndexController extends Controller
{
    public function crawl($urlSitemap = NULL, $url = NULL)
    {
//        $html = new DOMDocument();
//        //@$html->loadHtmlFile('http://www.icn.ch/es/Mapa-del-Sitio-1.html');// Spanish
//        @$html->loadHtmlFile($urlSitemap);
//        $xpath = new DOMXPath( $html );
//        $nodelist = $xpath->query( "//div[@class='contentpaneopen']" );
//        foreach ($nodelist as $n){
//            $arr = $n->getElementsByTagName("a");
//            foreach($arr as $item) {
//                $href =  $item->getAttribute("href");
//                $text = trim(preg_replace("/[\r\n]+/", " ", $item->nodeValue));
//                $links[$href][] = [
//                    'href' => 'http://www.icn.ch' . $href,
//                    'text' => $text
//                ];
//                echo $text . ';' . 'http://www.icn.ch' . $href . PHP_EOL;
//            }
//        }
//

//        $number = random_int(0, 100);
//
//        return new Response(
//            '<html><body>Lucky number: '.$number.'</body></html>'
//        );

        // creates a task and gives it some dummy data for this example
        $sitemapCrawler = new SitemapCrawler();
        $sitemapCrawler->setTask('Write a blog post');
        $sitemapCrawler->setDueDate(new \DateTime('tomorrow'));

        //$form = $this->createFormBuilder($task)
        $form = $this->createForm(SitemapCrawlerType::class, $sitemapCrawler)

            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'));
            //->getForm();

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));


    }

}