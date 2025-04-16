<?php

namespace App\Entity;

use App\Repository\SelectedVideoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SelectedVideoRepository::class)]
class SelectedVideo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $videoId = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $thumbnailUrl = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $publishedAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $selectedAt = null;

    #[ORM\ManyToOne(inversedBy: 'selectedVideos')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'selectedVideos')]
    private ?Instrument $instrument = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVideoId(): ?string
    {
        return $this->videoId;
    }

    public function setVideoId(string $videoId): static
    {
        $this->videoId = $videoId;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getThumbnailUrl(): ?string
    {
        return $this->thumbnailUrl;
    }

    public function setThumbnailUrl(string $thumbnailUrl): static
    {
        $this->thumbnailUrl = $thumbnailUrl;

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

    public function getInstrument(): ?Instrument
    {
        return $this->instrument;
    }

    public function setInstrument(?Instrument $instrument): static
    {
        $this->instrument = $instrument;

        return $this;
    }

    /**
     * Get the value of publishedAt
     *
     * @return ?\DateTime
     */
    public function getPublishedAt(): ?\DateTime
    {
        return $this->publishedAt;
    }

    /**
     * Set the value of publishedAt
     *
     * @param ?\DateTime $publishedAt
     *
     * @return self
     */
    public function setPublishedAt(?\DateTime $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get the value of selectedAt
     *
     * @return ?\DateTime
     */
    public function getSelectedAt(): ?\DateTime
    {
        return $this->selectedAt;
    }

    /**
     * Set the value of selectedAt
     *
     * @param ?\DateTime $selectedAt
     *
     * @return self
     */
    public function setSelectedAt(?\DateTime $selectedAt): self
    {
        $this->selectedAt = $selectedAt;

        return $this;
    }
}
