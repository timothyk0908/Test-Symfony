<?php
// src/OC/PlatformBundle/Entity/Skill.php

namespace TK\PresentationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="TK\PresentationBundle\Entity\SkillRepository")
 */
class Skill
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(name="name", type="string", length=255)
   */
  private $name;
  
  // Getters et setters
}