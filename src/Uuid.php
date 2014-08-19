<?php

namespace AndyTruong\Uuid;

/**
 * UUID Helper methods.
 */
class Uuid
{

    /**
     * Checks that a string appears to be in the format of a UUID.
     *
     * Implementations should not implement validation, since UUIDs should be in
     * a consistent format across all implementations.
     *
     * @param string $uuid
     *   The string to test.
     *
     * @return bool
     *   TRUE if the string is well formed, FALSE otherwise.
     */
    public static function isValid($uuid)
    {
        return (bool) preg_match("/^[0-9a-f]{8}-([0-9a-f]{4}-){3}[0-9a-f]{12}$/", $uuid);
    }

    /**
     * Get generator.
     * 
     * @staticvar null $generator
     * @return UuidInterface
     */
    public static function getGenerator()
    {
        static $generator = null;

        if (null === $generator) {
            if (function_exists('com_create_guid')) {
                $generator = new Com();
            }
            elseif (function_exists('uuid_create')) {
                $generator = new Pecl();
            }
            else {
                $generator = new Php();
            }
        }

        return $generator;
    }

}
