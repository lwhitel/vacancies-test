<?php
namespace Vacancy\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Localization
 *
 * @ORM\Table(name="localization")
 * @ORM\Entity
 */
class Localization
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=false)
     */
    protected $description;

    /**
     * @var \Vacancy\Entity\Language
     *
     * @ORM\ManyToOne(targetEntity="Vacancy\Entity\Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lang_id", referencedColumnName="id")
     * })
     */
    private $language;

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
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return void
     */
    public function setName($name)
    {
        $this->title = $name;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     *  Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param \Vacancy\Entity\Language $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     *  Get language.
     *
     * @return \Vacancy\Entity\Language
     */
    public function getLanguage()
    {
        return $this->language;
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