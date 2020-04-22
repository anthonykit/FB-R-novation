<?php


namespace App\Entity;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class Contact
{

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string|null $firstname
     * @return Contact
     */
    public function setFirstname(?string $firstname): contact
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string|null $lastname
     * @return Contact
     */
    public function setLastname(?string $lastname): Contact
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return Contact
     */
    public function setPhone(?string $phone): Contact
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Contact
     */
    public function setEmail(?string $email): Contact
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     * @return Contact
     */
    public function setMessage(?string $message): Contact
    {
        $this->message = $message;
        return $this;
    }
/**
 * @var string|null
 * @Assert\NotBlank()
 * @Assert\Length(min=2, max=200)
 */
private $firstname;
/**
 * @var string|null
 * @Assert\NotBlank()
 * @Assert\Length(min=2, max=200)
 */
private $lastname;
/**
 * @var string|null
 * @Assert\NotBlank()
 * @Assert\Regex(
 *  pattern="/[0-9]{10}/"
 * )
 */
private $phone;
/**
 * @var string|null
 * @Assert\NotBlank()
 * @Assert\Email()
 */
private $email;
/**
 * @var string|null
 * @Assert\NotBlank()
 * @Assert\Length(min=10)
 */
private $message;
}