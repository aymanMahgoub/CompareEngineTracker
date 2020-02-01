<?php

namespace Services;

use Doctrine\Common\Annotations\AnnotationReader;
use InvalidArgumentException;
use ReflectionObject;
use ReflectionProperty;

/**
 * Class CompareEngineTracker
 *
 * @package Services
 */
class CompareEngineTracker
{
    protected $changedList = [];

    protected $propertyTrackerAnnotation = "..\\Annotation\\PropertyTracker";

    protected $isChanged = false;

    /** @var AnnotationReader $reader */
    protected $reader;

    /**
     * CompareEngine constructor.
     * @param AnnotationReader $reader
     */
    public function __construct(AnnotationReader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @param $oldObject
     * @param $newObject
     *
     * @return array
     */
    public function compare($oldObject, $newObject)
    {
        if (!($oldObject instanceof $newObject)) {
            throw new InvalidArgumentException(sprintf('The Two Object Must Be From The Same Type'));
        }

        $reflectionObject = new ReflectionObject($oldObject);
        $reflectionProperties = $reflectionObject->getProperties(ReflectionProperty::IS_PRIVATE | ReflectionProperty::IS_PROTECTED);
        foreach ($reflectionProperties as $reflectionProperty) {
            $annotation = $this->reader->getPropertyAnnotation($reflectionProperty, $this->propertyTrackerAnnotation);

            if (null !== $annotation) {
                $propertyName = $reflectionProperty->getName();
                $method = $reflectionObject->hasMethod('get' . $propertyName) ? 'get' : 'is';
                $propertyMethod = $method . ucfirst($propertyName);
                $oldPropertyValue = $oldObject->$propertyMethod();
                $newPropertyValue = $newObject->$propertyMethod();

                if ($oldPropertyValue != $newPropertyValue) {
                    $this->changedList[$propertyName] = (object)array('oldVal' => $oldPropertyValue, 'newVal' => $newPropertyValue);
                    $this->isChanged = true;
                }
            }
        }

        return [
            'changedList' => $this->changedList,
            'isChanger' => $this->isChanged
        ];
    }

}
