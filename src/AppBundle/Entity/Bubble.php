<?php

// src/AppBundle/Entity/Bubble.php
namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Models title and text for a speech bubble.
 *
 * @ORM\Entity
 * @ORM\Table(name="bubble")
 */
class Bubble
{
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;
  /**
   * @Assert\NotBlank()
   * @ORM\Column(type="string", length=100)
   */
  protected $title;

  /**
   * @Assert\NotBlank()
   * @ORM\Column(type="string", length=180)
   */
  protected $message;

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    return $this->id = $id;
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function setTitle($title)
  {
    $this->title = $title;
  }

  public function getMessage()
  {
    return $this->message;
  }

  public function setMessage($message)
  {
    $this->message = $message;
  }
}
