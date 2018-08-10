<?php

namespace App\Entity;


class SitemapCrawler
{
    protected $url;

    protected $tag;

    protected $tagName;

    protected $attribute;

    protected $name;

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getTag()
    {
        return $this->tag;
    }

    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    public function getTagName()
    {
        return $this->tagName;
    }

    public function setTagName($tagName)
    {
        $this->tagName = $tagName;
    }

    public function getAttribute()
    {
        return $this->attribute;
    }

    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}