<?php


class News
{
    private $id;
    private $title;

    private $description;
    private $pubDate;

    private $link;
    private $category=array();





    function __construct($id=null, $titre=null, $description=null, $date=null, $lien=null)
    {
        $this->id = $id;
        $this->title = $titre;
        $this->description = $description;
        $this->pubDate = $date;

        $this->link = $lien;


    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param null $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPubDate()
    {
        return $this->pubDate;
    }

    /**
     * @param mixed $pubDate
     */
    public function setPubDate($pubDate)
    {
        $this->pubDate = $pubDate;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }


    /**
     * @return array
     */
    public function getCategory(): array
    {
        return $this->category;
    }
    /**
     * @param string $categorie
     */
    public function addCategory(string $category)
    {
        $this->category[] = $category;
    }




}