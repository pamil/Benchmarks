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
final class CallWithArgumentsBenchmark
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
        $this->callable->callWithArguments('arg1', 'arg2', 'arg3');
    }

    public function benchIndirectCallWithoutKeys()
    {
        $object = $this->callable;
        $method = 'callWithArguments';
        $arguments = ['arg1', 'arg2', 'arg3'];

        $object->$method(...$arguments);
    }

    public function benchCallUserFuncWithoutKeys()
    {
        $object = $this->callable;
        $method = 'callWithArguments';
        $arguments = ['arg1', 'arg2', 'arg3'];

        call_user_func([$object, $method], ...$arguments);
    }

    public function benchCallUserFuncArrayWithoutKeys()
    {
        $object = $this->callable;
        $method = 'callWithArguments';
        $arguments = ['arg1', 'arg2', 'arg3'];

        call_user_func_array([$object, $method], $arguments);
    }

    public function benchIndirectCallWithKeys()
    {
        $object = $this->callable;
        $method = 'callWithArguments';
        $arguments = array_values(['key1' => 'arg1', 'key2' => 'arg2', 'key3' => 'arg3']);

        $object->$method(...$arguments);
    }

    public function benchCallUserFuncWithKeys()
    {
        $object = $this->callable;
        $method = 'callWithArguments';
        $arguments = array_values(['key1' => 'arg1', 'key2' => 'arg2', 'key3' => 'arg3']);

        call_user_func([$object, $method], ...$arguments);
    }

    public function benchCallUserFuncArrayWithKeys()
    {
        $object = $this->callable;
        $method = 'callWithArguments';
        $arguments = ['key1' => 'arg1', 'key2' => 'arg2', 'key3' => 'arg3'];

        call_user_func_array([$object, $method], $arguments);
    }
}
