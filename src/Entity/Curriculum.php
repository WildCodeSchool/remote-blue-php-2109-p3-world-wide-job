<?php

namespace App\Entity;

use App\Repository\CurriculumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CurriculumRepository::class)
 */
class Curriculum
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
    private ?string $picture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $skills;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $language;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $drivingLicence;

    /**
     * @ORM\OneToOne(targetEntity=Student::class, inversedBy="curriculum", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Student $student;

    /**
     * @ORM\OneToMany(targetEntity=Experience::class, mappedBy="cv")
     */
    private ArrayCollection $experiences;

    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="curriculum")
     */
    private ArrayCollection $trainings;

    public function __construct()
    {
        $this->experiences = new ArrayCollection();
        $this->trainings = new ArrayCollection();
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

    public function getSkills(): ?string
    {
        return $this->skills;
    }

    public function setSkills(?string $skills): self
    {
        $this->skills = $skills;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getDrivingLicence(): ?bool
    {
        return $this->drivingLicence;
    }

    public function setDrivingLicence(?bool $drivingLicence): self
    {
        $this->drivingLicence = $drivingLicence;

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(Student $student): self
    {
        $this->student = $student;

        return $this;
    }

    /**
     * @return Collection|Experience[]
     */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    public function addExperience(Experience $experience): self
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences[] = $experience;
            $experience->setCurriculum($this);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): self
    {
        if ($this->experiences->removeElement($experience)) {
            // set the owning side to null (unless already changed)
            if ($experience->getCurriculum() === $this) {
                $experience->setCurriculum(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Training[]
     */
    public function getTrainings(): Collection
    {
        return $this->trainings;
    }

    public function addTraining(Training $training): self
    {
        if (!$this->trainings->contains($training)) {
            $this->trainings[] = $training;
            $training->setCurriculum($this);
        }

        return $this;
    }

    public function removeTraining(Training $training): self
    {
        if ($this->trainings->removeElement($training)) {
            // set the owning side to null (unless already changed)
            if ($training->getCurriculum() === $this) {
                $training->setCurriculum(null);
            }
        }

        return $this;
    }
}
