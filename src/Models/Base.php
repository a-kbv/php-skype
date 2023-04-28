<?php

namespace Akbv\PhpSkype\Models;

/**
 * Base class for all models.
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
abstract class Base
{
    public function injectObject($object)
    {
        // Set the dynamic property value
        $propertyName = get_class($object);
        $propertyName = substr($propertyName, strrpos($propertyName, '\\') + 1);
        $this->{$propertyName} = $object;

        // Generate the getter method
        $getterName = 'get' . ucfirst($propertyName);
        if (!method_exists($this, $getterName)) {
            $this->{$getterName} = function () use ($propertyName) {
                return $this->{$propertyName};
            };
        }

        // Return the property
        return $this->{$propertyName};
    }

    public function __call($method, $args)
    {
        if (isset($this->{$method}) && is_callable($this->{$method})) {
            $func = $this->{$method};
            return call_user_func_array($func, $args);
        }
        throw new \Exception('Undefined method: ' . $method);
    }

    protected function bindGetter($name, $getter)
    {
        $getterName = "get" . ucfirst($name);
        $this->{$getterName} = \Closure::bind($getter, $this, get_class($this));
    }

    /**
     * @return mixed[]
     * @throws \ReflectionException
     */
    final public function mapPropertiesToArray(): array
    {
        $reflectionClass = new \ReflectionClass(get_class($this));
        $array = [];
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array[$property->getName()] = $property->getValue($this);
            $property->setAccessible(false);
        }
        return $array;
    }

    /**
     * Map properties from array.
     * @param mixed[] $array
     * @return $this
     */
    final public function mapPropertiesFromArray(array $array): self
    {
        $class = new \ReflectionClass($this);
        $properties = $class->getProperties();
        foreach ($properties as $reflectionProperty) {
            if (array_key_exists($reflectionProperty->getName(), $array)) {
                $reflectionProperty->setAccessible(true);
                $reflectionProperty->setValue($this, $array[$reflectionProperty->getName()]);
            }
        }

        return $this;
    }

    public function fromArray(array $data): void
    {
        foreach ($data as $property => $value) {
            $property = str_replace('_', '', ucwords($property, '_'));
            $setter = 'set' . ucfirst($property);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
    }

    public function toArray(): array
    {
        $result = [];
        $refl = new \ReflectionObject($this);
        foreach ($refl->getProperties() as $property) {
            $getter = 'get' . ucfirst($property->getName());
            if (method_exists($this, $getter)) {
                $result[$property->getName()] = $this->$getter();
            }
        }
        return $result;
    }

    /**
     * Serialize the model to a JSON string.
     *
     * @return string
     */
    public function mapPropertiesToJson()
    {
        return json_encode($this->mapPropertiesToArray());
    }

    /**
     * Create a new instance from a JSON string.
     *
     * @param  string  $json
     * @return $this
     */
    public function mapPropertiesFromJson($json): self
    {
        $attributes = json_decode($json, true);

        return $this->mapPropertiesFromArray($attributes);
    }
}
