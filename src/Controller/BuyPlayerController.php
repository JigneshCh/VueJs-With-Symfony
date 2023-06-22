<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\Player;
use App\Entity\Bid;
use App\Entity\Transaction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BuyPlayerController extends AbstractController
{
    /**
     * @Route("/buy-player", name="buy-player")
     */
	public function index(Request $request): Response
	{
		$session = $request->getSession();
		$myteam = null;

		if ($request->query->has('myteam')) {
			$team_id = $request->query->get('myteam');
			$myteam = $this->getDoctrine()->getRepository(Team::class)->find($team_id);
			if ($myteam) {
				$session->set('myteam', $team_id);
			}
		} else if ($session->has('myteam')) {
			$team_id = $session->get('myteam');
			$myteam = $this->getDoctrine()->getRepository(Team::class)->find($team_id);
		}

		$teams = $this->getDoctrine()->getRepository(Team::class)->findBy([], ['name' => 'ASC']);
		if ($myteam) {
			$totakBids = $this->getTotalBids();
			return $this->render('buy/index.html.twig', compact('teams', 'myteam', 'totakBids'));
		} else {
			return $this->render('buy/index.html.twig', compact('teams', 'myteam'));
		}
	}
	
	/**
     * @Route("buy-player-payment", name="buy-player-payment", methods={"POST"})
     */
	public function store(Request $request)
	{
		$session = $request->getSession();
		$objectManager = $this->getDoctrine()->getManager();

		$result = ["data" => [], "code" => 400, "message" => ""];
		$bid_id = $request->get('bid_id');
		$team_id = intval($session->get('myteam'));
		$buyerTeam = $this->getDoctrine()->getRepository(Team::class)->find($team_id);
		$bid = $this->getDoctrine()->getRepository(Bid::class)->find($bid_id);

		if ($bid && $buyerTeam && $bid->getStatus() == "Active" && $bid->getTeam()->getId() != $team_id) {
			$sellerTeam = $bid->getTeam();
			$player = $bid->getPlayer();

			$price = floatval($bid->getBidPrice());
			$currentBalanceByer = floatval($buyerTeam->getBalance());
			$currentBalanceSeller = floatval($sellerTeam->getBalance());

			if ($currentBalanceByer > $price) {

				//Set new team for player
				$player->setTeam($buyerTeam);
				$objectManager->persist($player);

				//Debit from buyer
				$buyerTeam->setBalance($currentBalanceByer - $price);
				$objectManager->persist($buyerTeam);

				//Credit to seller
				$sellerTeam->setBalance($currentBalanceSeller + $price);
				$objectManager->persist($sellerTeam);

				//Update Bid status
				$bid->setStatus("Closed");
				$objectManager->persist($bid);

				//Transaction History
				$transaction = new Transaction();
				$transaction->setSeller($sellerTeam);
				$transaction->setBuyer($buyerTeam);
				$transaction->setPlayer($player);
				$transaction->setBid($bid);
				$transaction->setTransactionAmount($price);
				$objectManager = $this->getDoctrine()->getManager();
				$objectManager->persist($transaction);
				$objectManager->flush();

				$result['code'] = 200;
				$result['message'] = "Congratulations!! You have bought the player!";
			} else {
				$result['message'] = "You have low balance to buy the player";
			}
		} else {
			$result['message'] = "Invalid Data";
		}
		return $this->json($result);
	}
	
	/**
     * @Route("get-active-bids/{id}", name="get-active-bids")
     */
	public function getActiveBids($id, Request $request)
	{
		$result = ["data" => [], "pagination" => [], "code" => 400, "message" => ""];
		$pagination  = ["prev" => 0, "next" => 0];

		$totaltem = intval($request->get('totalitem', $this->getTotalBids()));
		$page = intval($request->get('page', 1));
		$per_page = 3;
		$offset = ($page - 1) * $per_page;

		if ($page > 1 && $totaltem > $per_page) {
			$pagination["prev"] = $page - 1;
		}
		if ($page * $per_page < $totaltem) {
			$pagination["next"] = $page + 1;
		}

		$bids = $this->getDoctrine()->getRepository(Bid::class)->findBy(['status' => 'Active'], ['id' => 'DESC'], $per_page, $offset);
		if (count($bids)) {
			$result['data'] = $this->listToArray($bids);
			$result['code'] = 200;
		} else {
			$result['message'] = "Invalid Data";
		}
		$result['pagination'] = $pagination;
		return $this->json($result);
	}

	/**
     * Get total active bids count
     */
	public function getTotalBids()
	{
		$totakBids = $this->getDoctrine()
			->getRepository(Bid::class)
			->createQueryBuilder('u')
			->select('count(u.id)')
			->andWhere('u.status = :val')->setParameter('val', "Active")
			->getQuery()
			->getSingleScalarResult();

		return intval($totakBids);
	}

	/**
     * Get bid data with parent objects
     */
	public function listToArray($dataitems)
	{
		$items = $dataitems;
		$result = [];
		foreach ($items as $item) {
			$team = $item->getTeam()->toArray();
			$player = $item->getPlayer()->toArray();
			$ondate = $item->getCreatedAt()->format('d-m-Y H:i');
			$obj = $item->toArray();
			$obj['team'] = $team;
			$obj['player'] = $player;
			$obj['ondate'] = $ondate;
			$result[] = $obj;
		}
		return $result;
	}
}