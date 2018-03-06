<?php
namespace AppBundle\Service;

use AppBundle\Entity\Position;

class Parse 
{
	
	const URL = 'https://yandex.ru/search/xml?user=vodohod-cruises&key=03.257827170:735c5d342eecc2da42c1ef9f1912faab&lr=';
	
    private $doctrine;

    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }
	
	public function curl_get_file_contents($URL)
	{
		$c = curl_init();
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($c, CURLOPT_URL, $URL);
		$contents = curl_exec($c);
		curl_close($c);

		if ($contents) return $contents;
			else return FALSE;
	}

    public function parse($domain_id)
    {

		ini_set("memory_limit","2G");
		ini_set("max_execution_time","1200");
	
		$em = $this->doctrine->getManager();
		

		
		$domain = $em->getRepository("AppBundle:Domain")->findOneById($domain_id);
		
		$keyWords = $em->getRepository("AppBundle:KeyWord")->findBy(['domain'=>$domain],['id'=>'ASC']);
		//$keyWords = $this->getDoctrine()->getRepository("AppBundle:KeyWord")->findBy(['id'=>42]);//
		
		$url = self::URL.$domain->getRegion();		
		
		$error = [];
		
		foreach($keyWords as $keyWord)
		{
			
			$pos = null;
			//$position = 0;
			
			
			for($i=1;$i<=3;$i++)
			{
				
				$position = 0;
				
				
				for($p=0 ; $p<=2; $p++)
				{
					$query = urlencode($keyWord->getText());
					$string = $this->curl_get_file_contents($url.'&query='.$query.'&p='.$p);
					$xml = simplexml_load_string($string);
					
					if(isset($xml->response->results->grouping->group))
					{
						foreach($xml->response->results->grouping->group as  $item)
						{
							$position++;
							$arr[] = $item;
							if(false !== strpos($item->doc->domain, $domain->getDomain()))
							{
								$pos = $position;
								break;
							}
						}
					}
					else
					{
						$error[$keyWord->getText()] = $xml;
					}
					
					if(null !== $pos)
					{
						$position = new Position();
						$position->setPosition($pos);
						$position->setDatetime(new \DateTime());
						$position->setKeyWord($keyWord);
						$em->persist($position);

						break;
					}
				}
				if(null !== $pos)
				{
					break;
				}
			}
			
			

			
			if(null === $pos)
			{
				$position = new Position();
				$position->setPosition(null);
				$position->setDatetime(new \DateTime());
				$position->setKeyWord($keyWord);
				$em->persist($position);				
			}
			
			

		}
		
		$em->flush();

		
		return "OK";
		
        // replace this example code with whatever you need
        //return $this->render('default/index.html.twig', [ $pos ,$xml, $error ]);
    }	
	
	
}