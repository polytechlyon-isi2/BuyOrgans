<?php


namespace BuyOrgans\DAO;


use BuyOrgans\Domain\Categorie;


class CategorieDAO extends DAO

{

    /**
     * Return a list of all Categories
     *
     * @return array A list of all Categories.
     */

    public function findAll() {

        $sql = "select * from t_categorie";

        $result = $this->getDb()->fetchAll($sql);


        // Convert query result to an array of domain objects

        $categories = array();

        foreach ($result as $row) {

            $categorieId = $row['cat_id'];

            $categories[$categorieId] = $this->buildDomainObject($row);

        }

        return $categories;

    }

    


    /**
     * Creates an Categorie object based on a DB row.
     *
     * @param array $row The DB row containing Categorie data.
     * @return \BuyOrgans\Domain\Categorie
     */

    protected function buildDomainObject($row) {

        $categorie = new categorie();

        $categorie->setId($row['cat_id']);

        $categorie->setTitle($row['cat_title']);

        $categorie->setImage($row['cat_img']);

        return $categorie;

    }

    /**
     * Returns an categorie matching the supplied id.
     *
     * @param integer $id
     *
     * @return \BuyOrgans\Domain\Categorie|throws an exception if no matching categorie is found
     */
    public function find($id) {
        $sql = "select * from t_categorie where cat_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No categorie matching id " . $id);
    }

}