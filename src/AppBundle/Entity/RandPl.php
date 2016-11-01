<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RandPl
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\RandPlRepository")
 */
class RandPl
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="randPlWord", type="integer")
     */
    private $randPlWord;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set randPlWord
     *
     * @param integer $randPlWord
     * @return RandPl
     */
    public function setRandPlWord($randPlWord)
    {
        $this->randPlWord = $randPlWord;

        return $this;
    }

    /**
     * Get randPlWord
     *
     * @return integer 
     */
    public function getRandPlWord()
    {
        return $this->randPlWord;
    }
}
