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
    // User propritaire de l'association c'est la que se fait la définition de la table de jointure
    #[ORM\ManyToMany(targetEntity: Role::class, inversedBy: 'users')]
    #[ORM\JoinTable(name: 'role_user')]
    private Collection $roles;
    

    /**
     * @var Collection<int, SelectedVideo>
     */
    #[ORM\OneToMany(targetEntity: SelectedVideo::class, mappedBy: 'user')]
    private Collection $selectedVideos;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->instrument = new ArrayCollection();
        $this->contributions = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->roles = new ArrayCollection();
        $this->selectedVideos = new ArrayCollection();
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
     * dois fournir un tableau de chaînes (exigé par l’interface UserInterface de Symfony), transformer cette collection d’objets Role en tableau de chaînes dans getRoles(). 
     * la méthode getrole retourne une chaine de caractère
     * @see UserInterface
     */
    // pour la sécurité 
    public function getRoles(): Array
    {
        // On récupère les noms des rôles associés à l'utilisateur
        // $roles = $this->roles->map(fn(Role $role) => $role->getNameRole())->toArray();

        // // Si aucun rôle n'est défini, on ajoute ROLE_USER par défaut
        // if (empty($roles)) {
        //     $roles[] = 'ROLE_USER';
        // }

        $roles = [];

        foreach ($this->roles as $role) {
            $roles[] = $role->getNameRole();
        }

        // garantir au moins ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    
    }

   /**
 * @return Collection|Role[]
 */
public function getRolesCollection(): Collection
{
    return $this->roles; // propriété ManyToMany vers Role
}

   
    
    public function setRolesCollection($roles)
    {
        $this->roles = $roles;
        return $this -> roles;
    }

    public function addRole(Role $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
        }

        return $this;
    }
// pour le formulaire : on retire un rôle de la collection d'objets Role


// removeRole(Role $role) est différent de delete().

// removeRole() est une méthode métier qui modifie l’état interne de l’objet User en retirant un rôle de sa collection.

// Cette méthode fait partie du comportement de la classe et donc doit être modélisée dans UML.
// delete() ou remove() (suppression en base)	Non	Opération de persistance externe, gérée par ORM ou service de persistance.

    public function removeRole(Role $role): self
    {

        if ($this->roles->removeElement($role)) {
            $role->removeUser($this); // Met à jour côté
        }

        return $this;
    }

    /**
     * @return Collection<int, SelectedVideo>
     */
    public function getSelectedVideos(): Collection
    {
        return $this->selectedVideos;
    }

    public function addSelectedVideo(SelectedVideo $selectedVideo): static
    {
        if (!$this->selectedVideos->contains($selectedVideo)) {
            $this->selectedVideos->add($selectedVideo);
            $selectedVideo->setUser($this);
        }

        return $this;
    }

    public function removeSelectedVideo(SelectedVideo $selectedVideo): static
    {
        if ($this->selectedVideos->removeElement($selectedVideo)) {
            // set the owning side to null (unless already changed)
            if ($selectedVideo->getUser() === $this) {
                $selectedVideo->setUser(null);
            }
        }

        return $this;
    }
}
