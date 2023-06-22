<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\Player;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlayerController extends AbstractController
{
	/**
	 * @Route("/", name="home")
	 */
	public function index(Request $request, PaginatorInterface $paginator): Response
	{
		$players = $this->getDoctrine()->getRepository(Player::class)->findBy([], ['id' => 'DESC']);
		$players = $paginator->paginate($players, $request->query->getInt('page', 1), 5);

		return $this->render('player/index.html.twig', compact('players'));
	}

	/**
	 * @Route("/player/create", name="create-player")
	 */
	public function create(): Response
	{
		$teams = $this->getDoctrine()->getRepository(Team::class)->findBy([], ['name' => 'ASC']);
		return $this->render('player/create.html.twig', compact('teams'));
	}

	/**
	 * @Route("player/store", name="store-player", methods={"POST"})
	 */
	public function store(Request $request)
	{

		$objectManager = $this->getDoctrine()->getManager();

		$item = new Player();
		$item->setName($request->request->get('name'));
		$item->setSurname($request->request->get('surname')); //
		$team_id = $request->request->get('team_id');
		$team = $this->getDoctrine()->getRepository(Team::class)->find($team_id);
		if ($team) {
			$item->setTeam($team);
		}
		$objectManager->persist($item);
		$objectManager->flush();

		$this->addFlash('success', 'You have created a new Player!');
		return $this->redirectToRoute('home');
	}

	/**
	 * @Route("player/delete", name="delete-player", methods={"POST"})
	 */
	public function delete(Request $request)
	{

		$objectManager = $this->getDoctrine()->getManager();
		$player_id = $request->request->get('player_id');
		$player = $this->getDoctrine()->getRepository(Player::class)->find($player_id);

		if ($player) {
			$bids = $player->getBids();
			if ($bids->count() > 0) {
				$this->addFlash('danger', 'Some Bid exist under this player!');
				return $this->redirectToRoute('team');
			} else {
				$objectManager->remove($player);
				$objectManager->flush();
				$this->addFlash('success', 'You have deleted Player!');
			}
		} else {
			$this->addFlash('error', 'Something went wrong!');
		}
		$objectManager->flush();
		return $this->redirectToRoute('home');
	}

	/**
	 * @Route("/player/edit/{id}", name="edit-player")
	 */
	public function edit($id)
	{
		$teams = $this->getDoctrine()->getRepository(Team::class)->findBy([], ['name' => 'ASC']);
		$objectManager = $this->getDoctrine()->getManager();
		$player = $objectManager->getRepository(Player::class)->find($id);

		if ($player) {
			return $this->render('player/edit.html.twig', compact('player', 'teams'));
		} else {
			$this->addFlash('error', 'Something went wrong!');
			return $this->redirectToRoute('home');
		}
	}

	/**
	 * @Route("/player/update/{id}", name="update-player", methods={"POST"})
	 */
	public function update(Request $request, $id)
	{
		$objectManager = $this->getDoctrine()->getManager();
		$player = $objectManager->getRepository(Player::class)->find($id);
		if ($player) {
			$player->setName($request->request->get('name'));
			$player->setSurname($request->request->get('surname'));
			$objectManager->flush();
			$this->addFlash('success', 'You have updated a Player!');
			return $this->redirectToRoute('home');
		} else {
			$this->addFlash('error', 'Something went wrong!');
			return $this->redirectToRoute('home');
		}
	}

	/**
	 * @Route("/get-players-by-team/{id}", name="players-by-team")
	 */
	public function getPlayersByTeam($id)
	{
		$result = ["data" => [], "code" => 400, "message" => ""];

		$objectManager = $this->getDoctrine()->getManager();
		$team = $objectManager->getRepository(Team::class)->find($id);

		if ($team) {
			//$team->getPlayers()->getValues();
			$result['data'] = $this->listToArray($team->getPlayers());
			$result['code'] = 200;
		} else {
			$result['message'] = "Invalid Data";
		}
		return $this->json($result);
	}

	/**
     * Get player data from parent objects team
     */
	public function listToArray($dataitems)
	{
		$items = $dataitems->toArray();
		$result = [];
		foreach ($items as $item) {
			$result[] = $item->toArray();
		}
		return $result;
	}
}
