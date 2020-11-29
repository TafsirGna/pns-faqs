<?php

namespace App\Entity;

use App\Repository\PlateformRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlateformRepository::class)
 */
class Plateform
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
     * @ORM\Column(type="string", length=255, nullable = true)
     */
    private $catisId;

    /**
     * @ORM\OneToMany(targetEntity=Faq::class, mappedBy="plateform")
     */
    private $faqs;

    public function __construct()
    {
        $this->faqs = new ArrayCollection();
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

    /**
     * @return Collection|Faq[]
     */
    public function getFaqs(): Collection
    {
        return $this->faqs;
    }

    public function addFaq(Faq $faq): self
    {
        if (!$this->faqs->contains($faq)) {
            $this->faqs[] = $faq;
            $faq->setPlateform($this);
        }

        return $this;
    }

    public function removeFaq(Faq $faq): self
    {
        if ($this->faqs->removeElement($faq)) {
            // set the owning side to null (unless already changed)
            if ($faq->getPlateform() === $this) {
                $faq->setPlateform(null);
            }
        }

        return $this;
    }
}
