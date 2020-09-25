<?php

declare(strict_types=1);

namespace Synchro\WordHash;

use ErrorException;
use RuntimeException;

/**
 * Class Hash.
 */
final class Hash
{
    /**
     * An array of words.
     *
     * @var array<string>
     */
    private static array $dictionary = [];

    /**
     * @param string $text The input text to generate a hash for
     * @param int $wordcount The number of words to use in the hash output, between 1 and 21
     * @param string $separator An optional separator string to insert between words
     */
    public static function generate(string $text, int $wordcount = 5, string $separator = '-'): string
    {
        //Validate length
        if ($wordcount < 1 || $wordcount > 21) {
            //Each word consumes exactly 3 hex chars from the hash, which has 64 chars,
            //so the longest we can do is 21 words
            throw new \InvalidArgumentException('$wordcount must be between 1 and 21');
        }

        if (self::$dictionary === []) {
            self::loadDictionary();
        }

        //Use sha512/256 because it's faster and safer than sha256
        $hash = substr(hash('sha512/256', $text, false), 0, $wordcount * 3);
        $words = [];
        //Split hash into 3-char chunks (because 16^3 = 4096)
        $chunks = str_split($hash, 3);
        foreach ($chunks as $chunk) {
            $words[] = trim(self::$dictionary[(int)hexdec($chunk)]);
        }

        return implode($separator, $words);
    }

    /**
     * Load an external dictionary file.
     *
     * @param string $path A path to a return-delimited word list
     */
    public static function loadDictionary(string $path = __DIR__ . '/dictionary.txt'): void
    {
        //Load the dictionary into memory and keep it
        try {
            $wordlist = file($path);
            if ($wordlist === false) {
                throw new RuntimeException('Failed to read dictionary, or dictionary empty');
            }
        } catch (ErrorException $exception) {
            throw new RuntimeException('Failed to read dictionary file', 0, $exception);
        }
        self::$dictionary = $wordlist;
    }
}
