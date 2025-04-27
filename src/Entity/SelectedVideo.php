<?php

namespace App\Entity;

use App\Repository\SelectedVideoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SelectedVideoRepository::class)]
class SelectedVideo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    private ?string $videoId = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $thumbnailUrl = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $publishedAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $selectedAt = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'selectedVideos')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $user = null;


    #[ORM\ManyToOne(targetEntity: Instrument::class, inversedBy: 'selectedVideos')]
    #[ORM\JoinColumn(name: 'instrument_id', referencedColumnName: 'id', nullable: true)]
    private ?Instrument $instrument = null;
    //SelectedVideo est le côté propriétaire (ManyToOne), c’est lui qui possède la clé étrangère instrument_id en base.

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVideoId(): ?string
    {
        return $this->videoId;
    }

    public function setVideoId(string $videoId): self
    {
        $this->videoId = $videoId;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getThumbnailUrl(): ?string
    {
        return $this->thumbnailUrl;
    }

    public function setThumbnailUrl(string $thumbnailUrl): self
    {
        $this->thumbnailUrl = $thumbnailUrl;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getInstrument(): ?Instrument
    {
        return $this->instrument;
    }

    public function setInstrument(?Instrument $instrument): self
    {
        $this->instrument = $instrument;
        return $this;
    }

    public function getPublishedAt(): ?\DateTime
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(?\DateTime $publishedAt): self
    {
        $this->publishedAt = $publishedAt;
        return $this;
    }

    public function getSelectedAt(): ?\DateTime
    {
        return $this->selectedAt;
    }

    public function setSelectedAt(?\DateTime $selectedAt): self
    {
        $this->selectedAt = $selectedAt;
        return $this;
    }
}
