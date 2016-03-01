<?php


namespace BuyOrgans\Domain;


class Categorie

{

    /**
     * Categorie id.
     *
     * @var integer
     */

    private $id;


    /**
     * Categorie title.
     *
     * @var string
     */

    private $title;


    /**
     * Categorie image.
     *
     * @var string
     */

    private $image;


    public function getId() {

        return $this->id;

    }


    public function setId($id) {

        $this->id = $id;

    }


    public function getTitle() {

        return $this->title;

    }


    public function setTitle($title) {

        $this->title = $title;

    }


    public function getImage() {

        return $this->image;

    }


    public function setImage($image) {

        $this->image = $image;

    }

}