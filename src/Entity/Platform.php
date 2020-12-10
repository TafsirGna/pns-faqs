<?php

namespace App\Entity;

use App\Repository\PlatformRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlatformRepository::class)
 */
class Platform
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $catisId;

    /**
     * @ORM\OneToOne(targetEntity=Faq::class, inversedBy="platform", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $faq;

    /**
     * @ORM\OneToMany(targetEntity=PlatformCluster::class, mappedBy="platform")
     */
    private $platformClusters;

    public function __construct()
    {
        $this->platformClusters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCatisId(): ?string
    {
        return $this->catisId;
    }

    public function setCatisId(string $catisId): self
    {
        $this->catisId = $catisId;

        return $this;
    }

    public function getFaq(): ?Faq
    {
        return $this->faq;
    }

    public function setFaq(Faq $faq): self
    {
        $this->faq = $faq;

        return $this;
    }

    /**
     * @return Collection|PlatformCluster[]
     */
    public function getPlatformClusters(): Collection
    {
        return $this->platformClusters;
    }

    public function addPlatformCluster(PlatformCluster $platformCluster): self
    {
        if (!$this->platformClusters->contains($platformCluster)) {
            $this->platformClusters[] = $platformCluster;
            $platformCluster->setPlatform($this);
        }

        return $this;
    }

    public function removePlatformCluster(PlatformCluster $platformCluster): self
    {
        if ($this->platformClusters->removeElement($platformCluster)) {
            // set the owning side to null (unless already changed)
            if ($platformCluster->getPlatform() === $this) {
                $platformCluster->setPlatform(null);
            }
        }

        return $this;
    }
}
