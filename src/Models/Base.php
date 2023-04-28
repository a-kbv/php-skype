<?php

namespace Akbv\PhpSkype\Models;

/**
 * Base class for all models.
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
abstract class Base
{
    /**
     * @param mixed $object
     * @return mixed
     */
    public function injectObject($object)
    {
        // Set the dynamic property value
        $propertyName = get_class($object);
        $propertyName = substr($propertyName, strrpos($propertyName, '\\') + 1);
        $this->{$propertyName} = $object;
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
