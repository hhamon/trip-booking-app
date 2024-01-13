# Auditing the Codebase

## Measuring Code Size

`phploc` is a tool for quickly measuring the size of a PHP project.

```bash
$ cd bin/
$ wget https://phar.phpunit.de/phploc.phar
$ chmod +x phploc.phar
```

```
$ symfony php bin/phploc.phar src/

phploc 7.0.2 by Sebastian Bergmann.

Directories                                         10
Files                                               52

Size
  Lines of Code (LOC)                             3843
  Comment Lines of Code (CLOC)                     392 (10.20%)
  Non-Comment Lines of Code (NCLOC)               3451 (89.80%)
  Logical Lines of Code (LLOC)                     853 (22.20%)
    Classes                                        853 (100.00%)
      Average Class Length                          16
        Minimum Class Length                         1
        Maximum Class Length                        72
      Average Method Length                          3
        Minimum Method Length                        0
        Maximum Method Length                       34
      Average Methods Per Class                      4
        Minimum Methods Per Class                    1
        Maximum Methods Per Class                   34
    Functions                                        0 (0.00%)
      Average Function Length                        0
    Not in classes or functions                      0 (0.00%)

Cyclomatic Complexity
  Average Complexity per LLOC                     0.18
  Average Complexity per Class                    3.94
    Minimum Class Complexity                      1.00
    Maximum Class Complexity                     24.00
  Average Complexity per Method                   1.65
    Minimum Method Complexity                     1.00
    Maximum Method Complexity                    10.00

Dependencies
  Global Accesses                                    0
    Global Constants                                 0 (0.00%)
    Global Variables                                 0 (0.00%)
    Super-Global Variables                           0 (0.00%)
  Attribute Accesses                               155
    Non-Static                                     155 (100.00%)
    Static                                           0 (0.00%)
  Method Calls                                     711
    Non-Static                                     693 (97.47%)
    Static                                          18 (2.53%)

Structure
  Namespaces                                        11
  Interfaces                                         0
  Traits                                             0
  Classes                                           52
    Abstract Classes                                 0 (0.00%)
    Concrete Classes                                52 (100.00%)
      Final Classes                                  2 (3.85%)
      Non-Final Classes                             50 (96.15%)
  Methods                                          223
    Scope
      Non-Static Methods                           221 (99.10%)
      Static Methods                                 2 (0.90%)
    Visibility
      Public Methods                               200 (89.69%)
      Protected Methods                              3 (1.35%)
      Private Methods                               20 (8.97%)
  Functions                                         10
    Named Functions                                  0 (0.00%)
    Anonymous Functions                             10 (100.00%)
  Constants                                         38
    Global Constants                                 0 (0.00%)
    Class Constants                                 38 (100.00%)
      Public Constants                              37 (97.37%)
      Non-Public Constants                           1 (2.63%)

```

## Detecting Code Duplication

`phpcpd` is a Copy/Paste Detector (CPD) for PHP code.

```bash
$ cd bin/
$ wget https://phar.phpunit.de/phpcpd.phar
$ chmod +x phpcpd.phar
```

```bash
$ symfony php bin/phpcpd.phar src

phpcpd 6.0.3 by Sebastian Bergmann.

Found 2 clones with 68 duplicated lines in 4 files:

  - /Users/hhamon/Code/legacy-trip-booking/src/Form/BookingOfferFiltersType.php:110-146 (36 lines)
    /Users/hhamon/Code/legacy-trip-booking/src/Form/BookingOfferSearchType.php:69-105

  - /Users/hhamon/Code/legacy-trip-booking/src/Form/RegistrationType.php:16-48 (32 lines)
    /Users/hhamon/Code/legacy-trip-booking/src/Form/SettingsType.php:17-49

1.77% duplicated lines out of 3843 total lines of code.
Average size of duplication is 34 lines, largest clone has 36 of lines

Time: 00:00.010, Memory: 4.00 MB
```
