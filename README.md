# Intro to Becnhmark

This Bundle provides @Benchmark annotation for symfony 2 for show log with a duration time process a determinated function or controler.

[![Build Status](https://api.travis-ci.org/izquierdogalan/BenchmarkBundle.png?branch=master)](http://travis-ci.org/izquierdogalan/BenchmarkBundle)

## Installation and configuration:

### Get the bundle

Add to your `/deps` file :

```
composer require izquierdogalan/benchmark-bundle
```

### Add BenchmarkBundle to your application kernel

``` php
<?php

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new Easys\BenchmarkBundle\EasysBenchmarkBundle(),
            // ...
        );
    }
```

## Usage examples:

You must use in controller or simple function allowed in methods:

``` php
<?php

/**
   * @Route("/{page}", name="home", defaults={"page": 1}, requirements={"page": "\d+" }, methods = { "GET" })
   * @Benchmark(description="Load index page.")
   * @Test()
   */
  public function indexAction($page)
  {
    return $this->render('EasysVideoPortalBundle:Orbit:Pages/index.html.twig');
  }
```
