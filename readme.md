## E-Dental

[![Preview](https://cloud.githubusercontent.com/assets/5093058/5860329/a0056576-a29b-11e4-844d-39839ec50b9d.png)](https://cloud.githubusercontent.com/assets/5093058/5860329/a0056576-a29b-11e4-844d-39839ec50b9d.png)


[![Author | Shields.io](http://img.shields.io/badge/author-%40srph-blue.svg?style=flat-square)](http://twitter.com/_srph)
[![MIT license](http://img.shields.io/badge/license-MIT-brightgreen.svg)](http://opensource.org/licenses/MIT)

An EDMS [quick work] for a project on IT22-FA3, built with Laravel.

### Author's Note

Upon creation, I was given ~7 hours to write the code while dealing with unfamiliarity (I haven't successively wrote PHP code for months) with code and table structure, and business logic [while considering the timeline and student's skills]. I am not trying to consent students to pay for their projects, but this was *commissioned* due to various confidential issues.

I regret for not using the *Repository Pattern*.

Plus, do not read this shit for *Best Practices™* . Thanks.

## Building

### Requirements

1. PHP ```>=5.4```
2. MySQL ```~5.5```
3. [Composer](https://getcomposer.org)
4. Bower (which requires ```npm``` and ```nodejs```)

### Installing

[1] **Get a local copy**. Or clone it with Git.

```bash
$ git clone https://github.com/srph/e-dental
```

[2]  **Update dependencies**

```bash
$ cd /path/to/e-dental # switch the current direct to the cloned repository

# Install PHP dependencies
$ composer install

# Install Bower (static assets) dependencies
$ bower install
```

[3] **Installing the database**

Create a database on MySQL first.

```bash
mysql -u root -p
CREATE DATABASE `edms`;
```

And then, register your machine to the list of detected environment at `bootstrap/start.php`:

```php
/*
|--------------------------------------------------------------------------
| Detect The Application Environment
|--------------------------------------------------------------------------
|
| Laravel takes a dead simple approach to your application environments
| so you can just specify a machine name for the host that matches a
| given environment, then we will automatically detect it for you.
|
*/
$env = $app->detectEnvironment(array(
	// Other environment..
	
	'your-environment-name' => array('your-machine-name'),
));
```

\* Replace `your-environment-name` with any unique name (this will be used to identify which environment (or configurations) to use), and `your-machine-name` of course the computer name.

Proceed to the configurations located at `app/config/` to create your own folder (the same as your environment name). And then create `database.php` on the same folder (now, you have `app/config/myMachine/database.php`).

Paste this in:

```php
<?php
return array(
	'default' => 'mysql',
	
	'connections' => array(
		'mysql' => array(
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'edms', // YOUR PREFERRED DB NAME
			'username'  => 'forge', // YOUR MYSQL USERNAME
			'password'  => 'forge', // YOUR MYSQL PASS
			/** reduced for bevity */
		),
	)
);
```

Run the migrations.

```bash
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
