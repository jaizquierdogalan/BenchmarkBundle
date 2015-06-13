<?php
namespace Easys\BenchmarkBundle\Aop;

use CG\Proxy\MethodInterceptorInterface;
use CG\Proxy\MethodInvocation;
use Doctrine\Common\Annotations\CachedReader;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;


class BenchmarkInterceptor implements MethodInterceptorInterface
{

    /** @var CachedReader */
    protected $annotationReader;
    /** @var  Logger */
    protected $logger;

    public function __construct($annotationReader, $logger)
    {
        $this->annotationReader=$annotationReader;
        $this->logger = $logger;
    }

    /**
     * Called when intercepting a method call.
     *
     * @param MethodInvocation $invocation
     * @return mixed the return value for the method invocation
     * @throws \Exception may throw any exception
     */
    function intercept(MethodInvocation $invocation)
    {
        $bench = $this->initUbench();
        $method = $invocation->reflection;
        $annotationObj=$this->annotationReader->getMethodAnnotation($method,'Easys\BenchmarkBundle\Aop\Benchmark');
        $data = $invocation->proceed();
        $bench->end();


        $this->logger->info(sprintf("%s , process time: %s, and memory usage: %s.",
            $annotationObj->description,
            $bench->getTime(),
            $bench->getMemoryUsage()
        ));

        return $data;
    }



    /**
     * @return \Ubench
     */
    private function initUbench()
    {
        $bench = new \Ubench();
        $bench->start();
        return $bench;
    }
}