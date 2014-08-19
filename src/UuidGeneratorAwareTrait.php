<?php

namespace AndyTruong\Uuid;

trait UuidGeneratorAwareTrait
{

    /** @var UuidInterface */
    private $uuid_generator;

    /** @var UuidInterface */
    private $uuid_generator;

    public function setUuidGenerator(UuidInterface $uuid_generator)
    {
        $this->uuid_generator = $uuid_generator;
        return $this;
    }

    public function getUuidGenerator()
    {
        return $this->uuid_generator;
    }

}
