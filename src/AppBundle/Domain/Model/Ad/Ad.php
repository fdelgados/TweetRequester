<?php

namespace AppBundle\Domain\Model\Ad;

class Ad
{
    /** @var  AdId */
    private $id;

    /** @var AdTitle */
    private $title;

    /** @var AdDescription */
    private $description;

    /** @var \DateTimeImmutable */
    private $publicationDate;

    public function __construct(
        AdId $id,
        AdTitle $title,
        AdDescription $description,
        \DateTimeImmutable $publicationDate
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->publicationDate = $publicationDate;
    }

    /**
     * @return AdId
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return AdTitle
     */
    public function title()
    {
        return $this->title;
    }

    /**
     * @return AdDescription
     */
    public function description()
    {
        return $this->description;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function publicationDate()
    {
        return $this->publicationDate;
    }
}
