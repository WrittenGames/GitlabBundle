WGGitlabBundle
==============

The GitlabBundle offers basic integration of the API introduced in Gitlab 2.7

## Installation

You'll need both the [Buzz library](kriswallsmith/Buzz)
and this bundle. Installation depends on how your project is set up:

### Step 1 (Symfony 2.1): Installation using composer.phar

Add the following lines in your composer.json

```
{
    "repositories": [
        {
            "type": "git",
            "url": "http://github.com/WrittenGames/GitlabBundle.git"
        }
    ],
    "require": {
        "writtengames/gitlab-bundle": "*"
    }
}
```

Run composer.phar.

### Step 1 (Symfony 2.0): Installation using the `bin/vendors.php` method

If you're using the `bin/vendors.php` method to manage your vendor libraries,
add the following entries to the `deps` file at the root of your project file:

```
[buzz]
    git=http://github.com/kriswallsmith/Buzz.git

[WGGitlabBundle]
    git=http://github.com/WrittenGames/GitlabBundle.git
    target=bundles/WG/GitlabBundle
```

Next, update your vendors by running:

``` bash
$ ./bin/vendors install
```

Great! Now skip down to *Step 2*.

### Step 1 (alternative): Installation with submodules

If you're managing your vendor libraries with submodules, simply add the two
following submodules:

``` bash
$ git submodule add git://github.com/kriswallsmith/Buzz.git vendor/buzz
$ git submodule add git://github.com/WrittenGames/GitlabBundle.git vendor/bundles/WG/GitlabBundle
```

Finally update your submodules:

``` bash
$ git submodule init
$ git submodule update
```

### Step 2: Configure the autoloader

Add the following entries to your autoloader:

``` php
<?php
// app/autoload.php

$loader->registerNamespaces(array(
    // ...

    'Buzz'          => __DIR__.'/../vendor/buzz/lib',
    'WG'            => __DIR__.'/../vendor/bundles',
));
```

### Step 3: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...

        new WG\GitlabBundle\WGGitlabBundle(),
    );
}
```

### Step4: Update your schema

```
php app/console doctrine:schema:update --force
```

Congratulations! You're ready to use the GitlabBundle!

## Basic Usage

``` php
<?php

use WG\GitlabBundle\Entity\Issue;

// Get API wrapper service:
$gitlab = $serviceContainer->get( 'gitlab.api' );

// Set access data:
$gitlab->setAccess( $access );

// Create an Issue instance and set two mandatory parameters:
$issue = new Issue( 'my-project-id', 'My Issue Title' );

// Optionally set some other parameters:
$issue->setDescription( 'Detailled description of my issue' );

// Save instance on Gitlab:
$gitlab->save( $issue );

// List all issues for a project:
$issues = $gitlab->listIssues( 'my-project-id' );
```

## Configuration

Your users will need to enter a Gitlab host and private token
in their profile before they can use the API. This bundle
offers a controller and templates for doing that which only
need to be included in your routing, and/or overridden in your
application.

# Storage

This bundle currently requires the Doctrine ORM. I may
decide to make it storage agnostic in a future version.
