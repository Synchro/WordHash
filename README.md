<p align="center">
    <img src="https://raw.githubusercontent.com/synchro/wordhash/master/docs/example.png" height="300" alt="Skeleton Php">
    <p align="center">
        <a href="https://github.com/synchro/wordhash/actions"><img alt="GitHub Workflow Status (master)" src="https://img.shields.io/github/workflow/status/synchro/wordhash/Continuous Integration/master"></a>
        <a href="https://packagist.org/packages/synchro/wordhash"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/synchro/wordhash"></a>
        <a href="https://packagist.org/packages/synchro/wordhash"><img alt="Latest Version" src="https://img.shields.io/packagist/v/synchro/wordhash"></a>
        <a href="https://packagist.org/packages/synchro/wordhash"><img alt="License" src="https://img.shields.io/packagist/l/synchro/wordhash"></a>
    </p>
</p>

------
# A PHP library for creating word-based hashes

![Test status](https://github.com/Synchro/WordHash/workflows/Tests/badge.svg)
![Psalm coverage](https://shepherd.dev/github/vimeo/psalm/coverage.svg?)

Hashes are very large numbers usually presented as hexadecimal (e.g. `5d41402abc4b2a76b9719d911017c592`) or base-64 strings (e.g. `XUFAKrxLKna5cZ2REBfFkg`). While it's easy for a computer to spot differences between random-looking strings, it's much harder for us humans. For example, it's difficult for you to tell whether `Mk3PAn3UowqTLEQfNlol6GsXPe+kuOWJSCU0cbgbcs8` and `Mk3PAn3UowqTLEQfNlo16GsXPe+kuOWJSCU0cbgbcs8` are the same simply by looking at them (they're not!). Sometimes you want a human-readable hash function that make differences more obvious, and that's what this library provides. It uses an SHA-512/256 hash truncated to 16 chars (by default) of hex output, and maps it into words drawn from a dictionary of 4096 common English words (originally randomly chosen from [this dictionary](https://github.com/dolph/dictionary/blob/master/popular.txt)). So for example the string `hello` produces a hash of `three-straps-solved-clutch-groove-abode`, and that's fairly easy for humans to tell apart from `three-straps-solved-lagoon-groove-abode`. Like all good hash functions, it produces wildly different output when presented with only very small differences in the input, so `hellp` produces `zlotys-south-remark-lier-rewind-accept`.

# Security warning!
This is **not** intended for high-performance or cryptographic purposes; **do not* hash your passwords with this function!

# Usage

```php
use Synchro\WordHash\Hash;
$hash = Hash::generate('hello!', 5, '_');
```
## Example output
```
boil_rife_crepe_trait_carted
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

✅ Run unit tests using **PEST**
```bash
composer test:unit
```

🚀 Run the entire test suite:
```bash
composer test
```

**Skeleton PHP** was created by **[Nuno Maduro](https://twitter.com/enunomaduro)** under the **[MIT license](https://opensource.org/licenses/MIT)**.
