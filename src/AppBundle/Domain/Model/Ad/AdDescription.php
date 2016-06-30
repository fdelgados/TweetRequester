<?php

namespace AppBundle\Domain\Model\Ad;

class AdDescription
{
    const MIN_LENGTH = 10;
    const MAX_LENGTH = 255;

    /** @var string */
    private $content;

    public function __construct($content)
    {
        $this->setDescription($content);
    }

    private function setDescription($content)
    {
        $this->assertNotEmpty($content);
        $this->assertNotTooShort($content);
        $this->assertNotTooLong($content);
        $this->content = $content;
    }

    private function assertNotEmpty($content)
    {
        if (empty($content)) {
            throw new \InvalidArgumentException('Empty description');
        }
    }

    private function assertNotTooShort($content)
    {
        if (strlen($content) < self::MIN_LENGTH) {
            throw new \InvalidArgumentException(sprintf('Description must be %d characters or more', self::MIN_LENGTH));
        }
    }

    private function assertNotTooLong($content)
    {
        if (strlen($content) > self::MAX_LENGTH) {
            throw new \InvalidArgumentException(sprintf('Description must be %d characters or less', self::MAX_LENGTH));
        }
    }
}
