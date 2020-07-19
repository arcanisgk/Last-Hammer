# Last Hammer

Last Hamer is a pre-built platform for creating applications, as if you were working with a framework; but particularly it has a graphical interface that allows starting in the following way:
-   Configure the System data.
-   Configure the Client / User / Company data.
-   Raise the system structure, based on form screens:
    -   Maintenance.
    -   Process stages screens.
    -   Approvals.
    -   Reports and Lists.

Note: It also has support for the Execution of Crons Jobs; but requires access to the System Cron Task Manager

## What you need to know when starting development:

Mainly used PHP in its latest version 7.4
HTML5 and a custom version of Bootstrap will also be used simply to enrich the color palette (Bootstrap 4.5).
Also CSS3 is used and in the Extensions area you will find the additional libraries and their versions.

## PSR version:

Last-Hammer does not use a specific version of PSR or code style, we can really consider that an anti-pattern is used, and all the system is embedded in the defined objects and constants, this will be better explained in the definition of classes, functions, variables and constants.

#### (The architecture proposed will not use namespace, lol)

-   Files should only use UTF-8 encoding without BOM.
-   Functions should only return a single value (it can be an array).
-   Space names and classes must follow the rules of the PSR-0.
-   Class names must be written using the StudlyCaps technique.
-   The constants must be defined in UPPERCASE and using underscore (\_) as separator.
-   Methods and functions should be written using the camelCase technique.
-   The idea must be with a tabulator set to 4 spaces (tabs or spaces).
-   The constants true, false and null must be written in lowercase.
-   You should no longer use the reserved word var to declare a property, you must use public, private, static or protected.
-   There must be a space after each control structure (if, for, foreach, while, switch, try ... catch, etc.).

## Contributing:

Thank you for considering contributing to the Last Hammer project! The contribution guide can be found in the Last Hammer documentation.

Security Vulnerabilities
If you discover a security vulnerability within Last Hammer, please send an e-mail to Walter Nuñez via icarosnet@gmail.com. All security vulnerabilities will be promptly addressed.

License
The Last Hammer project is open-source software licensed under the MIT license.

## Installation:

```
git clone https://github.com/arcanisgk/last-hammer
```
