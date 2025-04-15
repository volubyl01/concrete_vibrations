<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\UX\Turbo\Attribute\Broadcast;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
// pour valider les commentaire
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[Broadcast]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    // on valide le format de l'email coté serveur :
     #[Assert\NotBlank(message:"L'email est obligatoire.")]
     #[Assert\Email(message:"L'email '{{ value }}' n'est pas un email valide.")]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $user_name = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $user_instr = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $story = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profile_picture = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<int, Instrument>
     */
    #[ORM\OneToMany(targetEntity: Instrument::class, mappedBy: 'user')]
    private Collection $instrument;

    /**
     * @var Collection<int, Contribution>
     */
    #[ORM\OneToMany(targetEntity: Contribution::class, mappedBy: 'user')]
    private Collection $contributions;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'user')]
    private Collection $comments;

    /**
     * @var Collection<int, Role>
     */
    // users car un role peut avoir plusieurs users
    #[ORM\ManyToMany(targetEntity: Role::class, mappedBy: 'users')]
    private Collection $roles;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->instrument = new ArrayCollection();
        $this->contributions = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->roles = new ArrayCollection();
    }

    // nécessaire pour UserInterface
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    // nécessaire pour userinterface
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getUserName(): ?string
    {
        // on appelle la méthodde getuseridentifier pour récupérer l'email
        return $this->getUserIdentifier();
    }

 
    public function setUserName(?string $user_name): static
    {
        $this->user_name = $user_name;

        return $this;
    }

    public function getUserInstr(): ?string
    {
        return $this->user_instr;
    }

    public function setUserInstr(?string $user_instr): static
    {
        $this->user_instr = $user_instr;

        return $this;
    }

    public function getStory(): ?string
    {
        return $this->story;
    }

    public function setStory(?string $story): static
    {
        $this->story = $story;

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profile_picture;
    }

    public function setProfilePicture(?string $profile_picture): static
    {
        $this->profile_picture = $profile_picture;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Instrument>
     */
    public function getInstrument(): Collection
    {
        return $this->instrument;
    }

    public function addInstrument(Instrument $instrument): static
    {
        if (!$this->instrument->contains($instrument)) {
            $this->instrument->add($instrument);
            $instrument->setUser($this);
        }

        return $this;
    }

    public function removeInstrument(Instrument $instrument): static
    {
        if ($this->instrument->removeElement($instrument)) {
            // set the owning side to null (unless already changed)
            if ($instrument->getUser() === $this) {
                $instrument->setUser(null);
            }
        }

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
            $contribution->setUser($this);
        }

        return $this;
    }

    public function removeContribution(Contribution $contribution): static
    {
        if ($this->contributions->removeElement($contribution)) {
            // set the owning side to null (unless already changed)
            if ($contribution->getUser() === $this) {
                $contribution->setUser(null);
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
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @see UserInterface
     */
    // pour la sécurité 
    public function getRoles(): array
    {
        // On récupère les noms des rôles associés à l'utilisateur
        $roles = $this->roles->map(fn(Role $role) => $role->getNameRole())->toArray();

        // Si aucun rôle n'est défini, on ajoute ROLE_USER par défaut
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }
    
        return $roles;
    }

    /**
     * @return Collection<int, Role>
     */
    // pour le formulaire : retourne la collection d'objets Role
    public function getRolesCollection(): Collection
    {
        return $this->roles;
    }
    
    public function setRolesCollection($roles)
    {
        $this->roles = $roles;
        return $this -> roles;
    }

    public function addRole(Role $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles->add($role);
            $role->addUser($this);
        }

        return $this;
    }

    public function removeRole(Role $role): self
    {

        if ($this->roles->removeElement($role)) {
            $role->removeUser($this);
        }

        return $this;
    }
}
