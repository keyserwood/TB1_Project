<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 * @UniqueEntity(
 *     fields={"username","email"},
 *     message="Le user ou email existe déjà"
 * )
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password",message="Les mdp ne correspondent pas")
     */
    private $verifPassword;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $roles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Articles", mappedBy="author")
     */
    private $articles;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $email;


    private $verifRoles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaires", mappedBy="author")
     */
    private $commentaires;
    // Enable to change role without too much trouble

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    public function getVerifPassword(): ?string
    {
        return $this->verifPassword;
    }

    public function setVerifPassword(string $verifPassword): self
    {
        $this->verifPassword = $verifPassword;

        return $this;
    }
    public function getVerifRoles(): ?string
    {
        return $this->verifRoles;
    }

    public function setVerifRoles(?string $verifRoles): self
    {
        $this->verifRoles = $verifRoles;

        return $this;
    }
    public function getRoles()
    {
        return [$this->roles];
    }

    public function setRoles(?string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return Collection|Articles[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Articles $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setAuthor($this);
        }

        return $this;
    }

    public function removeArticle(Articles $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            // set the owning side to null (unless already changed)
            if ($article->getAuthor() === $this) {
                $article->setAuthor(null);
            }
        }

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }
    public function eraseCredentials()
    {
    }
    public function getSalt()
    {
    }

    /**
     * @return Collection|Commentaires[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaires $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setAuthor($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaires $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getAuthor() === $this) {
                $commentaire->setAuthor(null);
            }
        }

        return $this;
    }
}
