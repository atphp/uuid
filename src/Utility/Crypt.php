<?php

namespace AndyTruong\Uuid\Utility;

class Crypt
{

    /**
     * Returns a string of highly randomized bytes (over the full 8-bit range).
     *
     * This function is better than simply calling mt_rand() or any other built-in
     * PHP function because it can return a long string of bytes (compared to < 4
     * bytes normally from mt_rand()) and uses the best available pseudo-random
     * source.
     *
     * @param int $count
     *   The number of characters (bytes) to return in the string.
     *
     * @return string
     *   A randomly generated string.
     */
    public static function randomBytes($count)
    {
        // $random_state does not use drupal_static as it stores random bytes.
        static $random_state, $bytes;

        $missing_bytes = $count - strlen($bytes);

        if ($missing_bytes > 0) {
            // openssl_random_pseudo_bytes() will find entropy in a system-dependent
            // way.
            if (function_exists('openssl_random_pseudo_bytes')) {
                $bytes .= openssl_random_pseudo_bytes($missing_bytes);
            }

            // Else, read directly from /dev/urandom, which is available on many *nix
            // systems and is considered cryptographically secure.
            elseif ($fh = @fopen('/dev/urandom', 'rb')) {
                // PHP only performs buffered reads, so in reality it will always read
                // at least 4096 bytes. Thus, it costs nothing extra to read and store
                // that much so as to speed any additional invocations.
                $bytes .= fread($fh, max(4096, $missing_bytes));
                fclose($fh);
            }

            // If we couldn't get enough entropy, this simple hash-based PRNG will
            // generate a good set of pseudo-random bytes on any system.
            // Note that it may be important that our $random_state is passed
            // through hash() prior to being rolled into $output, that the two hash()
            // invocations are different, and that the extra input into the first one -
            // the microtime() - is prepended rather than appended. This is to avoid
            // directly leaking $random_state via the $output stream, which could
            // allow for trivial prediction of further "random" numbers.
            if (strlen($bytes) < $count) {
                // Initialize on the first call. The contents of $_SERVER includes a mix
                // of user-specific and system information that varies a little with
                // each page.
                if (!isset($random_state)) {
                    $random_state = print_r($_SERVER, TRUE);
                    if (function_exists('getmypid')) {
                        // Further initialize with the somewhat random PHP process ID.
                        $random_state .= getmypid();
                    }
                    $bytes = '';
                }

                do {
                    $random_state = hash('sha256', microtime() . mt_rand() . $random_state);
                    $bytes .= hash('sha256', mt_rand() . $random_state, TRUE);
                } while (strlen($bytes) < $count);
            }
        }
        $output = substr($bytes, 0, $count);
        $bytes = substr($bytes, $count);
        return $output;
    }

}
