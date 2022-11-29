<?php


namespace App\WebshopBundle\Application\RegisterCustomer;


class RegisterCustomerCommand
{

    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;
    protected $newsletter;



    public function __construct($firstname,$lastname,$email,$password,$newsletter)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->newsletter = $newsletter;
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
    public function getNewsletter()
    {
        return $this->newsletter;
    }
}