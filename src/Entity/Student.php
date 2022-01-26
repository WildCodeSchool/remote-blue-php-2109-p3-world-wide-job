<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 * @Vich\Uploadable
 */
class Student
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"application"})
     */
    protected int $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $picture = "";

    /**
     * @Vich\UploadableField(mapping="profile_file", fileNameProperty="picture")
     * @Assert\File(
     *     maxSize = "1M",
     *     mimeTypes = {"image/jpeg", "image/png", "image/webp"},
     * )
     * @var ?File
     */
    private ?File $pictureFile = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $ine;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="student", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private User $user;

    /**
     * @ORM\ManyToOne(targetEntity=School::class, inversedBy="students")
     * @ORM\JoinColumn(nullable=false)
     */
    private School $school;

    /**
     * @ORM\ManyToMany(targetEntity=Degree::class, inversedBy="students")
     * @var ArrayCollection<int, Degree>
     */
    private Collection $degree;

    /**
     * @ORM\OneToOne(targetEntity=Curriculum::class, mappedBy="student", cascade={"persist", "remove"})
     */
    private ?Curriculum $curriculum;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Application::class, mappedBy="student")
     */
    private Collection $applications;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $slug;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=true)
     */
    private string $username;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\ManyToMany(targetEntity=Offer::class, inversedBy="students")
     */
    private ArrayCollection $favorite;

    public function __construct()
    {
        $this->degree = new ArrayCollection();
        $this->applications = new ArrayCollection();
        $this->favorite = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }

    public function setPictureFile(?File $image = null): self
    {
        $this->pictureFile = $image;
        if ($image) {
            $this->updatedAt = new DateTime('now');
        }
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getIne(): ?string
    {
        return $this->ine;
    }

    public function setIne(?string $ine): self
    {
        $this->ine = $ine;

        return $this;
    }

    public function getSchool(): ?School
    {
        return $this->school;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function setSchool(School $school): self
    {
        $this->school = $school;

        return $this;
    }

    /**
     * @return Collection|Degree[]
     */
    public function getDegree(): Collection
    {
        return $this->degree;
    }

    public function addDegree(Degree $degree): self
    {
        if (!$this->degree->contains($degree)) {
            $this->degree[] = $degree;
        }

        return $this;
    }

    public function removeDegree(Degree $degree): self
    {
        $this->degree->removeElement($degree);

        return $this;
    }

    public function getCurriculum(): ?Curriculum
    {
        return $this->curriculum;
    }

    public function setCurriculum(Curriculum $curriculum): self
    {
        // set the owning side of the relation if necessary
        if ($curriculum->getStudent() !== $this) {
            $curriculum->setStudent($this);
        }

        $this->curriculum = $curriculum;

        return $this;
    }

    /**
     * @return Collection|Application[]
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function addApplication(Application $application): self
    {
        if (!$this->applications->contains($application)) {
            $this->applications[] = $application;
            $application->setStudent($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->removeElement($application)) {
            // set the owning side to null (unless already changed)
            if ($application->getStudent() == $this) {
                $application->setStudent(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
    public function __sleep()
    {
        return [];
    }

    /**
     * @return Collection|Offer[]
     */
    public function getFavorite(): Collection
    {
        return $this->favorite;
    }

    public function addFavorite(Offer $favorite): self
    {
        if (!$this->favorite->contains($favorite)) {
            $this->favorite[] = $favorite;
        }

        return $this;
    }

    public function removeFavorite(Offer $favorite): self
    {
        $this->favorite->removeElement($favorite);

        return $this;
    }

    public function isInFavorite(Offer $offer): bool
    {
        if ($this->getFavorite()->contains($offer)) {
            return true;
        } else {
            return false;
        }
    }
}
