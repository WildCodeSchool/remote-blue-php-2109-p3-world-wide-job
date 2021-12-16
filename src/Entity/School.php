<?php

namespace App\Entity;

use App\Repository\SchoolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SchoolRepository::class)
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $logo;

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
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $user;

    /**
     * @ORM\OneToMany(targetEntity=Student::class, mappedBy="school")
     */
    private ArrayCollection $students;

    /**
     * @ORM\OneToMany(targetEntity=Degree::class, mappedBy="school")
     */
    private ArrayCollection $degrees;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->degrees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
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

    public function removeStudent(Student $student): self
    {
        if ($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getSchool() == $this) {
                $student->setSchool(null);
            }
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
        if ($this->degrees->removeElement($degree)) {
            // set the owning side to null (unless already changed)
            if ($degree->getSchool() === $this) {
                $degree->setSchool(null);
            }
        }

        return $this;
    }
}
