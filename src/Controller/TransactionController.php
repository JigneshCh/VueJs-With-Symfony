<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\Transaction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TransactionController extends AbstractController
{
    /**
     * @Route("transaction/logs", name="transaction")
     */
    public function index(Request $request): Response
    {
		$session = $request->getSession();
		$myteam = null;
		
		$page = intval($request->get('page',1));
		$per_page = 3;
		$offset = ($page - 1) * $per_page;
		
		if($request->query->has('myteam')){
			$team_id = $request->query->get('myteam');
			$myteam = $this->getDoctrine()->getRepository(Team::class)->find($team_id);
			if($myteam){
				$session->set('myteam',$team_id);
			}
		}else if ($session->has('myteam')){
			$team_id = $session->get('myteam');
			$myteam = $this->getDoctrine()->getRepository(Team::class)->find($team_id);
		}
		
		$teams = $this->getDoctrine()->getRepository(Team::class)->findBy([],['name'=>'ASC']);
		
		if($myteam){
			$totalItems = $this->getDoctrine()->getRepository(Transaction::class)->createQueryBuilder('u')
			->select('count(u.id)')
            ->andWhere('u.seller = :val OR u.buyer = :val')->setParameter('val',$team_id)
			->getQuery()
            ->getSingleScalarResult();
			
			$totalPage = floor($totalItems/ $per_page);
			
			$logs = $this->getDoctrine()->getRepository(Transaction::class)->createQueryBuilder('u')
            ->andWhere('u.seller = :val OR u.buyer = :val')->setParameter('val',$team_id)
			->orderBy('u.id', 'DESC')
			->setMaxResults($per_page)
			->setFirstResult($offset)
            ->getQuery()
            ->getResult();
			
			return $this->render('transaction/index.html.twig',compact('teams','myteam','logs','totalItems','totalPage','page'));
		}else{
			return $this->render('transaction/index.html.twig',compact('teams','myteam'));
		}
    }
}














