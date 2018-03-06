<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Position;

use Liuggio\ExcelBundle;

class DefaultController extends Controller
{




    /**
* @Route("/export/{domain}/{date}", name="export")
     */	 
    public function exportAction(Request $request, $domain, $date)
	{
		$phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();
        $phpExcelObject->setActiveSheetIndex(0);

		$em = $this->getDoctrine()->getManager();
		
		//$date = new \DateTime($date);
		
		$qb = $em->createQueryBuilder()
			->select('k,p')
			->from('AppBundle\Entity\KeyWord','k')
			->leftJoin('k.positions','p')
			->where(" p.datetime like '".$date."%'")
			->andWhere("k.domain = ".$domain)
			//->groupBy('CONCAT(substring(p.datetime,1,10),'-',k.id)')
			->orderBy('k.id')
		;	
		
		$keyWords = $qb->getQuery()->getResult();

		dump($keyWords);
		
		$array = [];
		foreach($keyWords as $keyWord) 
		{
			
			$arr_keys[$keyWord->getId()] = $keyWord->getText();
			foreach($keyWord->getPositions() as $position)
			{
				$arr_dates[$position->getDatetime()->format("Y-m-d H")." ч"] = $position->getDatetime()->format("Y-m-d H")." ч";
				
				$array[$keyWord->getText()][$position->getDatetime()->format("Y-m-d H")." ч"] = $position->getPosition();
				
			}
			
			
		}
		
		asort($arr_dates);

		
		dump($array);
		
		 return $this->render('default/position.html.twig', [ 'array'=>$array,'arr_dates'=>$arr_dates, 'arr_keys'=>$arr_keys]);

		
       // $phpExcelObject->setCellValue('A1', 'Hello');
           
		
		
		$writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
		$response = $this->get('phpexcel')->createStreamedResponse($writer);
        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'отчёт.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;   		
		
	}

	

	

}
