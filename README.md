WGGitlabBundle
==============

The GitlabBundle offers basic integration of the API introduced in Gitlab 2.7

So far only the Gitlab API v2 is implemented. It can easily be extended to
include the Gitlab API v3 and the Github API v3. Merge requests welcome.

## Installation

You'll need both the [Buzz library](kriswallsmith/Buzz)
and this bundle. Installation depends on how your project is set up:

### Step 1: Installation using composer.phar

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

### Step 1 (alternative): Installation using the `bin/vendors.php` method

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

// Get credentials containing a user's token, a Gitlab host and an API version, e.g. via a form

$access = $this->getDoctrine()->getRepository( 'WGGitlabBundle:Access' )->find( $someId );

// Obtain an API implementation instance for provided credentials

$api = $this->get( 'gitlab' )->getAPI( $access );

// Call methods defined in WG\GitlabBundle\API\ApiInterface

$projects = $api->getProjects();

$issues = $api->getIssues();

```

Complete examples can be found in the built-in controllers.

## Configuration

Your users will need to enter a Gitlab host and private token
in their profile before they can use the API. This bundle
offers a controller and templates for doing that which only
need to be included in your routing, and/or overridden in your
application.

# Storage

This bundle currently requires the Doctrine ORM. I may
decide to make it storage agnostic in a future version.
