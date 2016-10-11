<?php

use Pamil\Benchmarks\CallableClass;
use PhpBench\Benchmark\Metadata\Annotations\BeforeMethods;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @Revs({1000000})
 * @Iterations(3)
 *
 * @BeforeMethods({"init"})
 */
final class CallWithoutArgumentsBenchmark
{
    /**
     * @var CallableClass
     */
    private $callable;

    public function init()
    {
        $this->callable = new CallableClass();
    }

    public function benchDirectCall()
    {
        $this->callable->call();
    }

    public function benchIndirectCall()
    {
        $object = $this->callable;
        $method = 'call';

        $object->$method();
    }

    public function benchCallUserFunc()
    {
        $object = $this->callable;
        $method = 'call';

        call_user_func([$object, $method]);
    }

    public function benchCallUserFuncArray()
    {
        $object = $this->callable;
        $method = 'call';

        call_user_func_array([$object, $method], []);
    }
}
