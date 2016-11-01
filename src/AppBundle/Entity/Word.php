<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Word
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\WordRepository")
 */
class Word
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
     * @var string
     *
     * @ORM\Column(name="engWord", type="string", length=255)
     */
    private $engWord;

    /**
     * @var string
     *
     * @ORM\Column(name="plWord", type="string", length=255)
     */
    private $plWord;


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
     * Set engWord
     *
     * @param string $engWord
     * @return Word
     */
    public function setEngWord($engWord)
    {
        $this->engWord = $engWord;

        return $this;
    }

    /**
     * Get engWord
     *
     * @return string 
     */
    public function getEngWord()
    {
        return $this->engWord;
    }

    /**
     * Set plWord
     *
     * @param string $plWord
     * @return Word
     */
    public function setPlWord($plWord)
    {
        $this->plWord = $plWord;

        return $this;
    }

    /**
     * Get plWord
     *
     * @return string 
     */
    public function getPlWord()
    {
        return $this->plWord;
    }
}
