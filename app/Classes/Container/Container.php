<?php

namespace Classes\Container;

use Classes\Utility\Exceptions\ContainerException;
use Classes\Utility\Exceptions\NotFoundException;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class Container implements ContainerInterface
{
    private array $entries = [];

    //id - is full Class name
    public function get(string $id)
    {
        if($this->has($id)) {
            $entry = $this->entries[$id];

            return $entry($this);
        }

        $this->resolve($id);
    }

    public function has(string $id): bool
    {
        return isset($this->$entries[$id]);
    }

    public function set(string $id, callable $concrete)
    {
        $this->entries[$id] = $concrete;
    }


    public function resolve(string $id)
    {
        //Inspect the class
        $reflection = new \ReflectionClass($id);

        if (!$reflection->isInstantiable()) throw new ContainerException('Class "' . $id . '" is not instantiable');

        //Inspect constructor of class
        $constructor = $reflection->getConstructor();
        if(!$constructor) return new $id;

        //Inspect constructor parameters (dependencies)
        $parameters = $constructor->getParameters();
        if(!$parameters) return new $id;

        // If the constructor param is a class -> resolve parameter with container
        $dependencies = array_map(function (\ReflectionParameter $parameter) use ($id) {
            $name = $parameter->getName();
            $type = $parameter->getType();

            if(!$type) {
                throw new ContainerException(
                    'Failed resolve the class "' . $id . '" because parameter "' . $name . '" is missing a type hint.'
                );
            }

            if($type instanceof \ReflectionUnionType) {
                throw new ContainerException(
                    'Failed resolve the class "' . $id . '" because of union type of "' . $name . '" parameter'
                );
            }


            if($type instanceof \ReflectionNamedType && ! $type->isBuiltin()) {
                return $this->get($type->getName());
            }

            throw new ContainerException(
                'Failed resolve the class "' . $id . '" because parameter "' . $name . '" is missing a type hint.'
            );

        }, $parameters);

        return  $reflection->newInstanceArgs($dependencies);
    }
}