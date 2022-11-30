<?php


namespace App\WebshopBundle\Application\CreateCustomer;


class CreateCustomerCommand
{

    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;
    protected $newsletterId;


    public function __construct($firstname,$lastname,$email,$password,$newsletterId = null)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->newsletterId = $newsletterId;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getNewsletterId()
    {
        return $this->newsletterId;
    }

    /**
     * @param mixed $newsletterId
     */
    public function setNewsletterId($newsletterId): void
    {
        $this->newsletterId = $newsletterId;
    }

}