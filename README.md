# A PHP library for creating word-based hashes

By Marcus Bointon ([@Synchro](https://github.com/Synchro)).

![Test Status](https://github.com/Synchro/WordHash/workflows/Tests/badge.svg)
![Type Coverage](https://shepherd.dev/github/vimeo/psalm/coverage.svg?)
<a href="https://packagist.org/packages/synchro/wordhash"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/synchro/wordhash"></a>
<a href="https://packagist.org/packages/synchro/wordhash"><img alt="Latest Version" src="https://img.shields.io/packagist/v/synchro/wordhash"></a>
<a href="https://packagist.org/packages/synchro/wordhash"><img alt="License" src="https://img.shields.io/packagist/l/synchro/wordhash"></a>

[Hashes](https://en.wikipedia.org/wiki/Hash_function) are functions which map arbitrary-sized data into a fixed size value. They are effectively very large numbers that are usually presented as hexadecimal (e.g. `5d41402abc4b2a76b9719d911017c592`) or base-64 strings (e.g. `XUFAKrxLKna5cZ2REBfFkg`).

While it's easy for a computer to spot differences between such random-looking strings, it's much harder for us humans. For example, it's difficult for you to tell whether `Mk3PAn3UowqTLEQfNlol6GsXPe+kuOWJSCU0cbgbcs8` and `Mk3PAn3UowqTLEQfNlo16GsXPe+kuOWJSCU0cbgbcs8` are the same simply by looking at them (they're not!). Sometimes you want a human-readable hash function that make differences more obvious, and that's what this library provides.

This library uses an SHA-512/256 hash truncated to 64 bits (by default), and maps it into words drawn from a dictionary of 4096 common English words (a random subset of [this dictionary](https://github.com/dolph/dictionary/blob/master/popular.txt)). The string `hello` produces a hash of `three-straps-solved-clutch-groove-abode`, and that's fairly easy for humans to tell apart from `three-straps-solved-lagoon-groove-abode`.

Like all good hash functions, it produces wildly different output when presented with only very small differences in the input, so `hellp` produces `zlotys-south-remark-lier-rewind-accept`.

You can choose how many words it generates (up to 21, equivalent to a 252-bit hash), and what separators are used between the words. It's also possible to substitute your own dictionary. 

# Security warning!
This is **not** intended for high-performance or cryptographic purposes; **do not hash your passwords with this function!**

# Usage
The `generate()` method takes three parameters:

* The string to hash (required)
* The number of words to use (optional, between 1 and 21, defaults to 5, the equivalent of a 45-bit hash)
* The separator to use between words (optional, defaults to `-`)

```php
use Synchro\WordHash\Hash;
echo Hash::generate('hello!', 5, '_');
```
## Example output
```
boil_rife_crepe_trait_carted
```

If you don't like the default words, or want to use emoji, HTML snippets or something else, you can provide your own dictionary, which must contain exactly 4096 **unique** return-delimited words (see the provided [`dictionary.txt`](https://github.com/Synchro/WordHash/blob/main/src/dictionary.txt) for reference). The words don't need to be in any particular order.
```php
Hash::loadDictionary('/path/to/my/dictionary.txt');
```

**Requires [PHP 7.4+](https://php.net/releases/)**

🧹 Lint the code using **PHP Codesniffer**:
```bash
composer lint
```

⚗️ Run static analysis using **PHPStan** or **Psalm**:
```bash
composer test:types
composer test:psalm
```

✅ Run unit tests using **Pest**
```bash
composer test:unit
```

🚀 Run the entire test suite:
```bash
composer test
```

**Skeleton PHP** was created by **[Nuno Maduro](https://twitter.com/enunomaduro)** under the **[MIT license](https://opensource.org/licenses/MIT)**.
