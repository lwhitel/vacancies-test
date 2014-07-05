<?php
namespace Vacancy\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vacancy
 *
 * @ORM\Table(name="vacancy")
 * @ORM\Entity
 */
class Vacancy
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \Vacancy\Entity\Localization
     *
     * @ORM\ManyToOne(targetEntity="Vacancy\Entity\Localization")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="local_id", referencedColumnName="id")
     * })
     */
    private $localization;

    /**
     * @var \Vacancy\Entity\Department
     *
     * @ORM\ManyToOne(targetEntity="Vacancy\Entity\Department")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     * })
     */
    private $department;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id.
     *
     * @param int $id
     *
     * @return void
     */
    public function setId($id)
    {
        $this->id = (int) $id;
    }

    /**
     * @param \Vacancy\Entity\Localization $localization
     */
    public function setLocalization($localization)
    {
        $this->localization = $localization;
    }

    /**
     * @return \Vacancy\Entity\Localization
     */
    public function getLocalization()
    {
        return $this->localization;
    }

    /**
     * @param \Vacancy\Entity\Department $department
     */
    public function setDepartment($department)
    {
        $this->department = $department;
    }

    /**
     * @return \Vacancy\Entity\Department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Helper function.
     */
    public function exchangeArray($data)
    {
        foreach ($data as $key => $val) {
            if (property_exists($this, $key)) {
                $this->$key = ($val !== null) ? $val : null;
            }
        }
    }

    /**
     * Helper function
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}