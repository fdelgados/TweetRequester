<?php

namespace AppBundle\Domain\Model\Ad;

use Rhumsaa\Uuid\Uuid;

class AdId
{
    /** @var string  */
    private $id;

    /**
     * AdId constructor.
     * @param null|string $id
     */
    private function __construct($id = null)
    {
        $this->id = (null === $id) ? Uuid::uuid4()->toString() : $id;
    }

    /**
     * @param null $anAdId
     * @return static
     */
    public static function create($anAdId = null)
    {
        return new static($anAdId);
    }

    /**
     * @return string
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @param AdId $anId
     * @return bool
     */
    public function equals(AdId $anId)
    {
        return $anId->id() === $this->id;
    }

    public function __toString()
    {
        return $this->id;
    }
}
