<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\Table(name: "benevole")]
class Benevole extends Utilisateur implements UserInterface,PasswordAuthenticatedUserInterface
{

    #[ORM\Column(type: 'string', length: 255)]
    public string $prenom;
    #[ORM\Column(type: 'string', length: 255)]
    public string $dateNaissance;

    #[ORM\Column(type: 'string', length: 255)]
    public string $experience ;
    #[ORM\Column(type: 'string', length: 255)]
    public string $skills ;


    #[ORM\OneToMany(mappedBy: 'benevole', targetEntity: Disponibilite::class)]
    private Collection $disponibilites;

    #[ORM\OneToMany(mappedBy: 'benevole', targetEntity: Notification::class)]
    private Collection $notifications;

    #[ORM\ManyToMany(targetEntity: Zone::class, inversedBy: 'benevoles')]
    #[ORM\JoinTable(name: 'benevole_zone')]
    private Collection $zones;

    #[ORM\ManyToMany(targetEntity: Mission::class, mappedBy: 'benevoles')]
    private Collection $missions;

    public function getMissions(): Collection
    {
        return $this->missions;
    }


    public function __construct()
    {
        $this->disponibilites = new ArrayCollection();
        $this->notifications = new ArrayCollection();
        $this->zones = new ArrayCollection();
    }



    public function getRoles(): array
    {
        return ['ROLE_BENEVOLE']; // Vous pouvez ajouter d'autres rôles si nécessaire
    }

    public function getSalt(): ?string
    {
        return null; // Vous pouvez retourner null si un algorithme comme bcrypt est utilisé
    }
    public function getUserIdentifier(): string
    {
        return $this->email; // Use the email or any unique identifier
    }

    public function eraseCredentials(): void
    {
        // Clear sensitive data if necessary (e.g., plain password), otherwise leave empty
    }




    public function getPassword(): string // Implémenter la méthode getPassword() de PasswordAuthenticatedUserInterface
    {
        return $this->motPasse;
    }

    public function setPassword(string $password): self
    {
        $this->motPasse = $password;
        return $this;
    }




    // Getters and Setters...

    public function getDisponibilites(): Collection
    {
        return $this->disponibilites;
    }

    public function addDisponibilite(Disponibilite $disponibilite): self
    {
        if (!$this->disponibilites->contains($disponibilite)) {
            $this->disponibilites->add($disponibilite);
            $disponibilite->setBenevole($this);
        }

        return $this;
    }

    public function removeDisponibilite(Disponibilite $disponibilite): self
    {
        if ($this->disponibilites->removeElement($disponibilite)) {
            if ($disponibilite->getBenevole() === $this) {
                $disponibilite->setBenevole(null);
            }
        }

        return $this;
    }

    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): self
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications->add($notification);
            $notification->setBenevole($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): self
    {
        if ($this->notifications->removeElement($notification)) {
            if ($notification->getBenevole() === $this) {
                $notification->setBenevole(null);
            }
        }

        return $this;
    }

    public function getZones(): Collection
    {
        return $this->zones;
    }

    public function addZone(Zone $zone): self
    {
        if (!$this->zones->contains($zone)) {
            $this->zones->add($zone);
        }

        return $this;
    }

    public function removeZone(Zone $zone): self
    {
        $this->zones->removeElement($zone);
        return $this;
    }
}
