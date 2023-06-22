<?php

namespace App\Controller;

use App\Entity\Team;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
	/**
	 * @Route("/team", name="team")
	 */
	public function index(Request $request, PaginatorInterface $paginator): Response
	{
		$teams = $this->getDoctrine()->getRepository(Team::class)->findBy([], ['id' => 'DESC']);
		$teams = $paginator->paginate($teams, $request->query->getInt('page', 1), 5);

		return $this->render('team/index.html.twig', compact('teams'));
	}

	/**
	 * @Route("/team/create", name="create-team")
	 */
	public function create(): Response
	{
		$countries = ['ar' => 'Argentina', 'fr' => 'France', 'br' => 'Brazil', 'be' => 'Belgium', 'gb' => 'England', 'nl' => 'Netherlands', 'it' => 'Italy', 'us' => 'United States', 'pt' => 'Portugal', 'gr' => 'Greece', 'dk' => 'Denmark'];
		return $this->render('team/create.html.twig', compact('countries'));
	}

	/**
	 * @Route("team/store", name="store-team", methods={"POST"})
	 */
	public function store(Request $request)
	{

		$objectManager = $this->getDoctrine()->getManager();

		$item = new Team();
		$item->setName($request->request->get('name'));
		$item->setCountryCode($request->request->get('country_code'));
		$coupon_code = $request->request->get('coupon_code');
		$balance = random_int(1000, 9999) * strlen($coupon_code)*2; //Test logic

		$item->setBalance($balance);

		$objectManager->persist($item);
		$objectManager->flush();

		$this->addFlash('success', 'You have created a new team!');
		return $this->redirectToRoute('team');
	}

	/**
	 * @Route("team/delete", name="delete-team", methods={"POST"})
	 */
	public function delete(Request $request)
	{

		$objectManager = $this->getDoctrine()->getManager();
		$team_id = $request->request->get('team_id');
		$team = $this->getDoctrine()->getRepository(Team::class)->find($team_id);
		if ($team) {
			$players = $team->getPlayers();
			//$players = $this->getDoctrine()->getRepository(Player::class)->findByTeam($team_id); 
			if ($players->count() > 0) {
				$this->addFlash('danger', 'This team have Players!');
				return $this->redirectToRoute('team');
			} else {
				$objectManager->remove($team);
				$objectManager->flush();
			}
			$this->addFlash('success', 'You have deleted Team!');
		} else {
			$this->addFlash('danger', 'Something went wrong!');
		}
		$objectManager->flush();
		return $this->redirectToRoute('team');
	}


	/**
	 * @Route("/team/edit/{id}", name="edit-team")
	 */
	public function edit($id)
	{
		$countries = ['ar' => 'Argentina', 'fr' => 'France', 'br' => 'Brazil', 'be' => 'Belgium', 'gb' => 'England', 'nl' => 'Netherlands', 'it' => 'Italy', 'us' => 'United States', 'pt' => 'Portugal', 'gr' => 'Greece', 'dk' => 'Denmark'];
		$objectManager = $this->getDoctrine()->getManager();
		$team = $objectManager->getRepository(Team::class)->find($id);

		if ($team) {
			return $this->render('team/edit.html.twig', compact('team', 'countries'));
		} else {
			$this->addFlash('error', 'Something went wrong!');
			return $this->redirectToRoute('home');
		}
	}

	/**
	 * @Route("/team/update/{id}", name="update-team", methods={"POST"})
	 */
	public function update(Request $request, $id)
	{
		$objectManager = $this->getDoctrine()->getManager();
		$team = $objectManager->getRepository(Team::class)->find($id);
		if ($team) {
			$team->setName($request->request->get('name'));
			$team->setCountryCode($request->request->get('country_code'));
			$objectManager->flush();
			$this->addFlash('success', 'You have updated a team!');
			return $this->redirectToRoute('home');
		} else {
			$this->addFlash('error', 'Something went wrong!');
			return $this->redirectToRoute('team');
		}
	}
}
