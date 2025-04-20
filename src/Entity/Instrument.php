<?php

namespace App\Entity;

use App\Repository\InstrumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: InstrumentRepository::class)]
#[Broadcast]
class Instrument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $manufacturer = null;

    #[ORM\Column(length: 50)]
    #[Assert\Choice(choices: ['synthétiseur', 'boite à rythmes', 'sampler'], message: 'Choisissez un type valide.')]
    private ?string $type_instr = null;

    #[ORM\Column(length: 100)]
    private ?string $name_instr = null;

    #[ORM\Column(length: 255)]
    private ?string $picture_url = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $year_instr = null;

    #[ORM\Column(type:'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?int $oscillators = null;

    #[ORM\Column(nullable: true)]
    private ?int $envelopes = null;

    #[ORM\Column(nullable: true)]
    private ?int $filter_instr = null;

    #[ORM\Column(nullable: true)]
    private ?int $lfos = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $polyphony = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $multitimbral = null;

    #[ORM\Column]
    private ?bool $isApproved = null;

    #[ORM\Column(type: 'json', nullable: true)]
    private ?array $synthesisType = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2, nullable: true)]
    private ?string $rating = null;

    #[ORM\Column(nullable: true)]
    private ?int $review_count = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'instrument')]
    private ?User $user = null;

    /**
     * @var Collection<int, Contribution>
     */
    #[ORM\OneToMany(targetEntity: Contribution::class, mappedBy: 'instrument')]
    private Collection $contributions;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'instrument')]
    private Collection $comments;

    public function __construct()
    {
        $this->contributions = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): static
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getTypeInstr(): ?string
    {
        return $this->type_instr;
    }

    public function setTypeInstr(string $type_instr): static
    {
        $this->type_instr = $type_instr;

        return $this;
    }

    public function getNameInstr(): ?string
    {
        return $this->name_instr;
    }

    public function setNameInstr(string $name_instr): static
    {
        $this->name_instr = $name_instr;

        return $this;
    }

    public function getPictureUrl(): ?string
    {
        return $this->picture_url;
    }

    public function setPictureUrl(string $picture_url): static
    {
        $this->picture_url = $picture_url;

        return $this;
    }

    public function getYearInstr(): ?int
    {
        return $this->year_instr;
    }

    public function setYearInstr(int $year_instr): static
    {
        $this->year_instr = $year_instr;

        return $this;
    }



    public function getOscillators(): ?int
    {
        return $this->oscillators;
    }

    public function setOscillators(?int $oscillators): static
    {
        $this->oscillators = $oscillators;

        return $this;
    }

    public function getEnvelopes(): ?int
    {
        return $this->envelopes;
    }

    public function setEnvelopes(?int $envelopes): static
    {
        $this->envelopes = $envelopes;

        return $this;
    }

    public function getFilterInstr(): ?int
    {
        return $this->filter_instr;
    }

    public function setFilterInstr(?int $filter_instr): static
    {
        $this->filter_instr = $filter_instr;

        return $this;
    }

    public function getLfos(): ?int
    {
        return $this->lfos;
    }

    public function setLfos(?int $lfos): static
    {
        $this->lfos = $lfos;

        return $this;
    }

    public function getPolyphony(): ?string
    {
        return $this->polyphony;
    }

    public function setPolyphony(?string $polyphony): static
    {
        $this->polyphony = $polyphony;

        return $this;
    }

    public function getMultitimbral(): ?string
    {
        return $this->multitimbral;
    }

    public function setMultitimbral(?string $multitimbral): static
    {
        $this->multitimbral = $multitimbral;

        return $this;
    }

    public function isApproved(): ?bool
    {
        return $this->isApproved;
    }

    public function setIsApproved(bool $isApproved): static
    {
        $this->isApproved = $isApproved;

        return $this;
    }

    public function getSynthesisType(): ?array
    {
        if (is_string($this->synthesisType)) {
            return json_decode($this->synthesisType, true);
        }

        return $this->synthesisType;
    }

    public function getSynthesisTypeString(): ?string
    {
        if (is_array($this->synthesisType)) {
            return json_encode($this->synthesisType);
        }

        return $this->synthesisType;
    }

  

    public function setSynthesisType(?array $synthesisType): self
    {
        $this->synthesisType = $synthesisType;
        return $this;
    }
  

    public function getRating(): ?string
    {
        return $this->rating;
    }

    public function setRating(?string $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getReviewCount(): ?int
    {
        return $this->review_count;
    }

    public function setReviewCount(?int $review_count): static
    {
        $this->review_count = $review_count;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Contribution>
     */
    public function getContributions(): Collection
    {
        return $this->contributions;
    }

    public function addContribution(Contribution $contribution): static
    {
        if (!$this->contributions->contains($contribution)) {
            $this->contributions->add($contribution);
            $contribution->setInstrument($this);
        }

        return $this;
    }

    public function removeContribution(Contribution $contribution): static
    {
        if ($this->contributions->removeElement($contribution)) {
            // set the owning side to null (unless already changed)
            if ($contribution->getInstrument() === $this) {
                $contribution->setInstrument(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setInstrument($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getInstrument() === $this) {
                $comment->setInstrument(null);
            }
        }

        return $this;
    }

    /**
     * Get the value of description
     *
     * @return ?string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param ?string $description
     *
     * @return self
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
