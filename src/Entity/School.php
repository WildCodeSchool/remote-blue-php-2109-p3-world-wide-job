<?php

namespace App\Entity;

use App\Repository\SchoolRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=SchoolRepository::class)
 * @Vich\Uploadable
 */
class School
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private string $logo = "";

    /**
     * @Vich\UploadableField(mapping="profile_file", fileNameProperty="logo")
     * @Assert\File(
     *     maxSize = "1M",
     *     mimeTypes = {"image/jpeg", "image/png", "image/webp"},
     * )
     * @var ?File
     */
    private ?File $logoFile = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $schoolName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $schoolCode;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $schoolDesc;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $type;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="school", cascade={"persist", "remove"})
     */
    private ?User $user = null;

    /**
     * @ORM\OneToMany(targetEntity=Student::class, mappedBy="school")
     */
    private Collection $students;

    /**
     * @ORM\OneToMany(targetEntity=Degree::class, mappedBy="school")
     */
    private Collection $degrees;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $slug;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $updatedAt;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->degrees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;
        return $this;
    }

    public function setLogoFile(?File $image = null): void
    {
        $this->logoFile = $image;
        if ($image) {
            $this->updatedAt = new DateTime('now');
        }
    }

    public function getLogoFile(): ?File
    {
        return $this->logoFile;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getSchoolName(): ?string
    {
        return $this->schoolName;
    }

    public function setSchoolName(?string $schoolName): self
    {
        $this->schoolName = $schoolName;

        return $this;
    }

    public function getSchoolCode(): ?string
    {
        return $this->schoolCode;
    }

    public function setSchoolCode(?string $schoolCode): self
    {
        $this->schoolCode = $schoolCode;

        return $this;
    }

    public function getSchoolDesc(): ?string
    {
        return $this->schoolDesc;
    }

    public function setSchoolDesc(?string $schoolDesc): self
    {
        $this->schoolDesc = $schoolDesc;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): self
    {
        $this->type = $type;

        return $this;
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

    /**
     * @return Collection|Student[]
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->setSchool($this);
        }

        return $this;
    }

    /**
     * @return Collection|Degree[]
     */
    public function getDegrees(): Collection
    {
        return $this->degrees;
    }

    public function addDegree(Degree $degree): self
    {
        if (!$this->degrees->contains($degree)) {
            $this->degrees[] = $degree;
            $degree->setSchool($this);
        }

        return $this;
    }

    public function removeDegree(Degree $degree): self
    {
        if (!$this->degrees->contains($degree)) {
            if ($degree->getDegree() == $this) {
                $degree->setDegree(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
