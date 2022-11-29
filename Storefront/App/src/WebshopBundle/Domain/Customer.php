<?php


namespace App\WebshopBundle\Domain;


class Customer
{
    protected int $id;
    protected string $email;
    protected string $password;
    protected string $firstName;
    protected $newsletterSubscription;

    /**
     * @return bool
     */
    public function hasNewsletter()
    {
        return $this->newsletterSubscription;
    }

    /**
     * @param bool $newsletter
     */
    public function setNewsletterSubscription(NewsletterSubscriber $newsletter)
    {
        $this->newsletterSubscription = $newsletter;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    protected string $lastName;

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

}