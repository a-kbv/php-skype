<?php

namespace Akbv\PhpSkype\Models;

use JsonSerializable;

/**
 * Base class for all models.
 * @license https://opensource.org/licenses/BSD-3-Clause  BSD 3-Clause License
 * @author Atanas Korabov
 */
abstract class Base implements \JsonSerializable
{
    /**
     * @var string
     */
    protected $eventClassName;

    /**
     * @param mixed $object
     * @return mixed
     */
    public function injectObject($object)
    {
        // Set the dynamic property value
        $propertyNameFull = get_class($object);
        $propertyName = substr($propertyNameFull, strrpos($propertyNameFull, '\\') + 1);
        $this->{$propertyName} = $object;
        $this->{"eventClassName"} = $propertyNameFull;
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
            $name = $property->getName();
            $array[$name] = $property->getValue($this);
            if (ctype_upper($name[0])) {
                $name = lcfirst($name);
                $array[$name] = $property->getValue($this);
            }
            $property->setAccessible(false);
        }
        return $array;
    }

    /**
     * @return mixed[]
     */
    public function jsonSerialize(): array
    {
        $reflectedClass = new \ReflectionClass($this);
        $propertiesArray = [];

        foreach ($reflectedClass->getProperties() as $property) {
            $property->setAccessible(true);
            $propertyName = $property->getName();
            $propertyValue = $property->getValue($this);

            if (is_object($propertyValue) && method_exists($propertyValue, 'mapPropertiesToArray')) {
                $propertiesArray[$propertyName] = $propertyValue->mapPropertiesToArray();
            } else {
                $propertiesArray[$propertyName] = $propertyValue;
            }
        }

        return $propertiesArray;
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

    /**
     * Get the value of eventClassName
     *
     * @return  string
     */
    public function getEventClassName()
    {
        return $this->eventClassName;
    }
}
