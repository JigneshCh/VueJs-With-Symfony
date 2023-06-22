<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\Player;
use App\Entity\Bid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BidController extends AbstractController
{
	/**
	 * @Route("/sell-player", name="sell-player")
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
			return $this->render('bid/index.html.twig', compact('teams', 'myteam'));
		} else {
			return $this->render('bid/index.html.twig', compact('teams', 'myteam'));
		}
	}

	/**
	 * @Route("edit-player-bid", name="edit-player-bid", methods={"POST"})
	 */
	public function getPlayersBid(Request $request)
	{
		$result = ["data" => [], "code" => 400, "message" => ""];
		$player_id = $request->request->get('player_id');
		$player = $this->getDoctrine()->getRepository(Player::class)->find($player_id);

		if ($player) {
			$team = $player->getTeam();
			if ($team) {
				$bid = $this->getDoctrine()->getRepository(Bid::class)->findOneBy(array('status' => 'Active', 'team' => $team->getId(), 'player' => $player->getId()));
				if ($bid) {
					$ondate = $bid->getCreatedAt()->format('d-m-Y H:i');
					$result['data'] = $bid->toArray();
					$result['data']['ondate'] = $ondate;
					$result['code'] = 200;
				}
			}
		} else {
			$result['message'] = "Invalid Data";
		}
		return $this->json($result);
	}

	/**
	 * @Route("bid/delete", name="delete-bid", methods={"POST"})
	 */
	public function delete(Request $request)
	{
		$result = ["data" => [], "code" => 400, "message" => ""];
		$objectManager = $this->getDoctrine()->getManager();
		$bid_id = $request->request->get('bid_id');
		$bid = $this->getDoctrine()->getRepository(Bid::class)->find($bid_id);

		if ($bid) {
			$objectManager->remove($bid);
			$objectManager->flush();
			$result['code'] = 200;
			$result['message'] = "You have deleted Bid!";
		} else {
			$result['message'] = "Invalid Data";
		}
		return $this->json($result);
	}

	/**
	 * @Route("bid/store", name="create-bid", methods={"POST"})
	 */
	public function store(Request $request)
	{
		$result = ["data" => [], "code" => 400, "message" => ""];
		$bid_price = $request->request->get('bid_price');
		$player_id = $request->request->get('player_id');
		$player = $this->getDoctrine()->getRepository(Player::class)->find($player_id);

		if ($player) {
			$team = $player->getTeam();
			if ($team) {
				$bid = $this->getDoctrine()->getRepository(Bid::class)->findBy(array('status' => 'Active', 'team' => $team->getId(), 'player' => $player->getId()));
				if ($bid) {
					$result['message'] = "Bid allready exist!";
				} else {
					$item = new Bid();
					$item->setBidPrice($bid_price);
					$item->setStatus("Active");
					$item->setPlayer($player);
					$item->setTeam($team);
					$objectManager = $this->getDoctrine()->getManager();
					$objectManager->persist($item);
					$objectManager->flush();

					$result['code'] = 200;
					$result['message'] = "You have created new Bid!";
				}
			}
		} else {
			$result['message'] = "Invalid Data";
		}
		return $this->json($result);
	}

	/**
	 * @Route("bid/update", name="update-bid", methods={"POST"})
	 */
	public function update(Request $request)
	{
		$result = ["data" => [], "code" => 400, "message" => ""];
		$bid_price = $request->request->get('bid_price');
		$bid_id = $request->request->get('bid_id');
		$bid = $this->getDoctrine()->getRepository(Bid::class)->find($bid_id);

		if ($bid) {
			$objectManager = $this->getDoctrine()->getManager();
			$bid->setBidPrice($bid_price);
			$objectManager->flush();
			$result['message'] = "Bid Updated!";
			$result['code'] = 200;
		} else {
			$result['message'] = "Invalid Data";
		}
		return $this->json($result);
	}
}