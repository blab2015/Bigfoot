<?php

namespace Sandbox\CastingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

use Sandbox\CastingBundle\Model\Person;

/**
 * Actor
 *
 * @ORM\Table(name="sandbox_actor")
 * @ORM\Entity(repositoryClass="Sandbox\CastingBundle\Entity\ActorRepository")
 */
class Actor extends Person
{
    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Sandbox\MovieBundle\Entity\Movie", mappedBy="actors")
     */
    private $movies;

    /**
     * Construct Actor
     */
    public function __construct()
    {
        $this->movies = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getFullName();
    }

    /**
     * @param Movie $movie
     * @return $this
     */
    public function addMovie(Movie $movie)
    {
        $this->movies[] = $movie;

        return $this;
    }

    /**
     * @param Movie $movie
     * @return $this
     */
    public function removeMovie(Movie $movie)
    {
        $this->movies->removeElement($movie);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getMovies()
    {
        return $this->movies;
    }
}