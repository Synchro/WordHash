<?php

declare(strict_types=1);

use Synchro\WordHash\Hash;

it(
    'validates minimum word count',
    function () {
        Hash::generate('test', 0);
    }
)->throws(InvalidArgumentException::class);

it(
    'validates maximum word count',
    function () {
        Hash::generate('test', 22);
    }
)->throws(InvalidArgumentException::class);

it(
    'produces an expected hash',
    function () {
        expect(Hash::generate('test'))->toBe('doth-little-given-daze-basin');
    }
);

it(
    'produces the expected number of words',
    function () {
        for ($l = 1; $l < 22; ++$l) {
            $hash = Hash::generate('test', $l);
            $words = explode('-', $hash);
            expect(count($words))->toBe($l);
        }
    }
);

it(
    'detects a difference in input strings',
    function () {
        $hash1 = Hash::generate('test1');
        $hash2 = Hash::generate('test2');
        expect($hash1)->not->toBe($hash2);
    }
);

//Run this test last as it will break other tests otherwise
it(
    'detects a missing dictionary',
    function () {
        Hash::loadDictionary('xyz123');
        Hash::generate('test1');
    }
)->throws(RuntimeException::class);
