<?php

namespace BuyOrgans\DAO;

use BuyOrgans\Domain\Article;

class ArticleDAO extends DAO
{
    /**
     * Return a list of all articles, sorted by date (most recent first).
     *
     * @return array A list of all articles.
     */
    public function findAll() {
        $sql = "select * from t_article order by art_id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $articles = array();
        foreach ($result as $row) {
            $articleId = $row['art_id'];
            $articles[$articleId] = $this->buildDomainObject($row);
        }
        return $articles;
    }

    /**
     * Creates an Article object based on a DB row.
     *
     * @param array $row The DB row containing Article data.
     * @return \BuyOrgans\Domain\Article
     */
    protected function buildDomainObject($row) {
        $article = new Article();
        $article->setId($row['art_id']);
        $article->setTitle($row['art_title']);
        $article->setDescription($row['art_description']);
        $article->setPrice($row['art_price']);
        $article->setCategorie($row['art_categorie']);
        $article->setImage($row['art_img']);
        return $article;
    }

    /**
     * Returns an article matching the supplied id.
     *
     * @param integer $id
     *
     * @return \BuyOrgans\Domain\Article|throws an exception if no matching article is found
     */
    public function find($id) {
        $sql = "select * from t_article where art_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No article matching id " . $id);
    }
    
    /**
     * Return a list of all articles witch are in the categorie id, sorted by date (most recent first).
     *
     * @param integer $id
     *
     * @return \BuyOrgans\Domain\Article|throws an exception if no matching article is found
     */
    public function findByCategorie($catid) {
        $sql = "select * from t_article where art_categorie=? order by art_id desc";
        $result = $this->getDb()->fetchAll($sql, array($catid));

        if ($result){
             //Convert query result to an array of domain objects
            $articles = array();
            foreach ($result as $row) {
                $articleId = $row['art_id'];
                $articles[$articleId] = $this->buildDomainObject($row);
            }
            return $articles;
        }
        else
            throw new \Exception("No article matching in category id " . $catid);
    }

}

