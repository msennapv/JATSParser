<?php

class BibitemChapter {
    private $type;
    private $id;
    private $name;
    private $editor;
    private $chapterTitle;
    private $collabAuthor;
    private $collabEditor;
    private $source;
    private $publisherLoc;
    private $publisherName;
    private $year;
    private $fpage;
    private $lpage;
    private $doi;
    private $pmid;
    private $url;

    public function __construct() {
        $this->name = new ArrayObject(array());
        $this->editor = new ArrayObject(array());
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return ArrayObject
     */
    public function getName(): ArrayObject
    {
        if ($this->name == null) {
            $this->name = new ArrayObject();
        }
        return $this->name;
    }

    /**
     * @param ArrayObject $name
     */
    public function setName(ArrayObject $name)
    {
        $this->name = $name;
    }

    /**
     * @return ArrayObject
     */
    public function getEditor(): ArrayObject
    {
        if ($this->editor == null) {
            $this->editor = new ArrayObject();
        }
        return $this->editor;
    }

    /**
     * @param ArrayObject $editor
     */
    public function setEditor(ArrayObject $editor)
    {
        $this->editor = $editor;
    }

    /**
     * @return mixed
     */
    public function getChapterTitle()
    {
        return $this->chapterTitle;
    }

    /**
     * @param mixed $chapterTitle
     */
    public function setChapterTitle($chapterTitle)
    {
        $this->chapterTitle = $chapterTitle;
    }

    /**
     * @return mixed
     */
    public function getCollabAuthor()
    {
        return $this->collabAuthor;
    }

    /**
     * @param mixed $collabAuthor
     */
    public function setCollabAuthor($collabAuthor)
    {
        $this->collabAuthor = $collabAuthor;
    }

    /**
     * @return mixed
     */
    public function getCollabEditor()
    {
        return $this->collabEditor;
    }

    /**
     * @param mixed $collabEditor
     */
    public function setCollabEditor($collabEditor)
    {
        $this->collabEditor = $collabEditor;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param mixed $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return mixed
     */
    public function getPublisherLoc()
    {
        return $this->publisherLoc;
    }

    /**
     * @param mixed $publisherLoc
     */
    public function setPublisherLoc($publisherLoc)
    {
        $this->publisherLoc = $publisherLoc;
    }

    /**
     * @return mixed
     */
    public function getPublisherName()
    {
        return $this->publisherName;
    }

    /**
     * @param mixed $publisherName
     */
    public function setPublisherName($publisherName)
    {
        $this->publisherName = $publisherName;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getFpage()
    {
        return $this->fpage;
    }

    /**
     * @param mixed $fpage
     */
    public function setFpage($fpage)
    {
        $this->fpage = $fpage;
    }

    /**
     * @return mixed
     */
    public function getLpage()
    {
        return $this->lpage;
    }

    /**
     * @param mixed $lpage
     */
    public function setLpage($lpage)
    {
        $this->lpage = $lpage;
    }

    /**
     * @return mixed
     */
    public function getDoi()
    {
        return $this->doi;
    }

    /**
     * @param mixed $doi
     */
    public function setDoi($doi)
    {
        $this->doi = $doi;
    }

    /**
     * @return mixed
     */
    public function getPmid()
    {
        return $this->pmid;
    }

    /**
     * @param mixed $pmid
     */
    public function setPmid($pmid)
    {
        $this->pmid = $pmid;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }


}