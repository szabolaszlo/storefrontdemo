<?php


namespace App\WebshopBundle\Application\Registration;


class RegistrationCommand
{

    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;
    protected $subscribeToNewsletter;


    public function __construct($firstname,$lastname,$email,$password,$subscribeToNewsletter = false)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->subscribeToNewsletter = $subscribeToNewsletter;
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
    public function needToSubscribeNewsletter()
    {
        return $this->subscribeToNewsletter;
    }

}