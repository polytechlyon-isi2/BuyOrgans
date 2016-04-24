<?php

namespace BuyOrgans\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    /**
     * User id.
     *
     * @var integer
     */
    private $id;

    /**
     * User name.
     *
     * @var string
     */
    private $username;

    /**
     * User DisplayedName
     *
     * @var string
     */
    private $userdisplayedname;

    /**
     * User password.
     *
     * @var string
     */
    private $password;

    /**
     * Salt that was originally used to encode the password.
     *
     * @var string
     */
    private $salt;

    /**
     * Role.
     * Values : ROLE_USER or ROLE_ADMIN.
     *
     * @var string
     */
    private $role;

    /**
     * City
     * the city the user lives in.
     *
     * @var string
     */
    private $city;

    /**
     * Address
     * the address of the user
     *
     * @var string
     */
    private $address;

    /**
     * postalcode
     * the postal code of the user's city.
     *
     * @var string
     */
    private $postalcode;



    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getPostalcode() {
        return $this->postalcode;
    }

    public function setPostalcode($postalcode) {
        $this->postalcode = $postalcode;
    }



    /**
     * @inheritDoc
     */
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }


    public function getUserdisplayedname() {
        return $this->userdisplayedname;
    }

    public function setUserdisplayedname($userdisplayedname) {
        $this->userdisplayedname = $userdisplayedname;
    }


    /**
     * @inheritDoc
     */
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array($this->getRole());
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials() {
        // Nothing to do here
    }
}