<?php

namespace AndyTruong\Uuid;

trait UuidGeneratorAwareTrait
{

    /** @var UuidInterface */
    private $uuid_generator;

    /**
     * Set uuid generator.
     *
     * @param \AndyTruong\Uuid\UuidInterface $uuid_generator
     * @return self
     */
    public function setUuidGenerator(UuidInterface $uuid_generator)
    {
        $this->uuid_generator = $uuid_generator;
        return $this;
    }

    /**
     * Get uuid generator.
     * 
     * @return \AndyTruong\Uuid\UuidInterface
     */
    public function getUuidGenerator()
    {
        return $this->uuid_generator;
    }

}
