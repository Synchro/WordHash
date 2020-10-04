<?php

declare(strict_types=1);

use Synchro\WordHash\WordHash;

it(
    'validates minimum word count',
    function () {
        WordHash::generate('test', 0);
    }
)->throws(InvalidArgumentException::class);

it(
    'validates maximum word count',
    function () {
        WordHash::generate('test', 22);
    }
)->throws(InvalidArgumentException::class);

it(
    'produces an expected hash',
    function () {
        expect(WordHash::generate('test'))->toBe('doth-little-given-daze-basin');
    }
);

it(
    'produces the expected number of words',
    function () {
        for ($l = 1; $l < 22; ++$l) {
            $hash = WordHash::generate('test', $l);
            $words = explode('-', $hash);
            expect(count($words))->toBe($l);
        }
    }
);

it(
    'detects a difference in input strings',
    function () {
        $hash1 = WordHash::generate('test1');
        $hash2 = WordHash::generate('test2');
        expect($hash1)->not->toBe($hash2);
    }
);

//Run this test last as it will break other tests otherwise
it(
    'detects a missing dictionary',
    function () {
        WordHash::loadDictionary('xyz123');
        WordHash::generate('test1');
    }
)->throws(RuntimeException::class);
