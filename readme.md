## E-Dental

[![Author | Shields.io](http://img.shields.io/badge/author-%40srph-blue.svg?style=flat-square)](http://twitter.com/_srph)
[![Author | Shields.io](http://img.shields.io/badge/author-%40srph-blue.svg?style=flat-square)](http://twitter.com/_srph)
[![MIT license](http://img.shields.io/badge/license-MIT-brightgreen.svg)](http://opensource.org/licenses/MIT)

An EDMS [quick work] for Jealian's (:heart:) project on IT22-FA3, built with Laravel.

### Author's Note

Upon creation, I was given ~7 hours to write the code while dealing with unfamiliarity (I haven't successively wrote PHP code for months) with code and table structure, and business logic [while considering the timeline and student's skills]. I am not trying to consent students to pay for their projects, but this was made due to the problems that arose.

Plus, do not read this shit for Best Practices. Thanks.

## Building

### Requirements

1. PHP ```>=5.4```
2. MySQL ```~5.5```
3. [Composer](https://getcomposer.org)
4. Bower (which requires ```npm``` and ```nodejs```)

### Installing

1. **Get a local copy**. Or clone it with Git.

```
$ git clone https://github.com/srph/e-dental
```

2.  Update dependencies

```
$ cd /path/to/e-dental # switch the current direct to the cloned repository

# Install PHP dependencies
$ composer install

# Install Bower (static assets) dependencies
$ bower install
```

3. Installing the database

Create a database, first.

```
# on your root folder
$ php artisan migrate # run the table migration
$ php artisan db:seed # seed data
```

## Acknowledgement

**e-dental** © 2014+, Kier Borromeo (srph). Released under the [MIT](http://mit-license.org/) License.<br>

> [srph.github.io](http://srph.github.io) &nbsp;&middot;&nbsp;
> GitHub [@srph](https://github.com/srph) &nbsp;&middot;&nbsp;
> Twitter [@_srph](https://twitter.com/_srph)

[MIT]: http://mit-license.org/