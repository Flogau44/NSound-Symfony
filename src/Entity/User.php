<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[ApiResource]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    // Getter pour l'ID
    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter pour l'email
    public function getEmail(): ?string
    {
        return $this->email;
    }

    // Setter pour l'email
    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    // Getter pour le nom
    public function getName(): ?string
    {
        return $this->name;
    }

    // Setter pour le nom
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Un identifiant visuel qui représente cet utilisateur.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    // Getter pour les rôles
    public function getRoles(): array
    {
        $roles = $this->roles;
        // garantir que chaque utilisateur a au moins ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    // Setter pour les rôles
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    // Getter pour le mot de passe
    public function getPassword(): ?string
    {
        return $this->password;
    }

    // Setter pour le mot de passe
    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    // Effacer les informations d'identification
    public function eraseCredentials(): void
    {
        // Si vous stockez des données temporaires et sensibles sur l'utilisateur, effacez-les ici
        // $this->plainPassword = null;
    }
}
