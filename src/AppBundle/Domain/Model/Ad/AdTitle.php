<?php

namespace AppBundle\Domain\Model\Ad;

class AdTitle
{
    const MIN_LENGTH = 5;
    const MAX_LENGTH = 60;

    /** @var string */
    private $content;

    public function __construct($content)
    {
        $this->setTitle($content);
    }

    private function setTitle($content)
    {
        $this->assertNotEmpty($content);
        $this->assertNotTooShort($content);
        $this->assertNotTooLong($content);
        $this->content = $content;
    }

    private function assertNotEmpty($content)
    {
        if (empty($content)) {
            throw new \InvalidArgumentException('Empty title');
        }
    }

    private function assertNotTooShort($content)
    {
        if (strlen($content) < self::MIN_LENGTH) {
            throw new \InvalidArgumentException(sprintf('Title must be %d characters or more', self::MIN_LENGTH));
        }
    }

    private function assertNotTooLong($content)
    {
        if (strlen($content) > self::MAX_LENGTH) {
            throw new \InvalidArgumentException(sprintf('Title must be %d characters or less', self::MAX_LENGTH));
        }
    }
}
