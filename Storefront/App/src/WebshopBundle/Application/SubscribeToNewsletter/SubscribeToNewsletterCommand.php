<?php
namespace App\WebshopBundle\Application\SubscribeToNewsletter;

class SubscribeToNewsletterCommand
{

    protected string $fistname;
    protected string $lastname;
    protected string $email;
    protected mixed $customer;

    public function __construct($firstname, $lastname,$email,$customer = false)
    {
        $this->email = $email;
        $this->lastname = $lastname;
        $this->fistname = $firstname;
        $this->customer = $customer;
    }

    /**
     * @return string
     */
    public function getFistname(): string
    {
        return $this->fistname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return mixed|null
     */
    public function getCustomer(): mixed
    {
        return $this->customer;
    }
}