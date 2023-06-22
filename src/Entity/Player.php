<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 */
class Player
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $surname;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="team")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;
	
	private $team_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;
	
	/**
     * @ORM\OneToMany(targetEntity="Bid", mappedBy="player")
     */
    private $bids;

    public function __construct()
    {
        $this->created_at = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
	
	public function toArray() {
        return get_object_vars($this);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }
	
	public function getTeam(): ?Team
    {
        return $this->team;
    }
	public function setTeam(?Team $tean): self
    {
        $this->team = $tean;
    
        return $this;
    }
	
	public function getBids()
    {
        return $this->bids;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }
}