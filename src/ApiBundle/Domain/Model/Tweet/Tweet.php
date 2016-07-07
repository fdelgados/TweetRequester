<?php

namespace ApiBundle\Domain\Model\Tweet;

class Tweet implements \JsonSerializable
{
    /** @var  string */
    private $id;

    /** @var string */
    private $text;

    /** @var  \DateTimeImmutable */
    private $createdAt;
    
    public function __construct($id, $text, \DateTimeImmutable $createdAt)
    {
        $this->id = $id;
        $this->text = $text;
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function text()
    {
        return $this->text;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function createdAt()
    {
        return $this->createdAt;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
