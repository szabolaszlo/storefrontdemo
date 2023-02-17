<?php


namespace App\WebshopBundle\Application\Account;


use App\WebshopBundle\Domain\Model\Customer\Customer;

class QueryCustomerAccountResponse
{

    protected $firstname;
    protected $lastname;
    protected $email;
    protected $customerId;
    protected $subscriptionId = null;


    public function __construct(Customer $customer,$subscriptionId = null)
    {
        $this->customerId = $customer->getId();
        $this->email = $customer->getEmail();
        $this->lastname = $customer->getLastName();
        $this->firstname = $customer->getFirstName();
        $this->subscriptionId = $subscriptionId;
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
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @return mixed|null
     */
    public function getSubscriptionId(): mixed
    {
        return $this->subscriptionId;
    }



}