<?php

namespace BeSimple\DatagridBundle\Utils;

class ObjectRefection
{
    private $object;
    private $classes;

    /**
     * @param object $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }

    /**
     * @static
     * @param object $object
     * @param bool $reverse
     * @param bool $toUnderscore
     * @return array
     */
    static public function subtypeNames($object, $reverse = false, $toUnderscore = false)
    {
        $reflection = new self($object);
        $reflection->inspectClassNames($reverse);

        $classes = $reflection->getSubtypeNames($toUnderscore);

        return $reverse ? array_reverse($classes) : $classes;
    }

    /**
     * @static
     * @param object $object
     * @param string $property
     * @return mixed
     */
    static public function read($object, $property)
    {
        list($reflection, $property) = self::walk($object, $property);

        return $reflection->readProperty($property);
    }

    /**
     * @static
     * @param object $object
     * @param string $property
     * @return void
     */
    static public function write(& $object, $property)
    {
        list($reflection, $property) = self::walk($object, $property);

        return $reflection->writeProperty($property);
    }

    /**
     * @static
     * @param object $object
     * @param string $property
     * @return array
     */
    static public function walk(& $object, $property)
    {
        $path = explode('.', $property);

        if (count($path) === 1) {
            return array(new self($object), $property);
        }

        $finalProperty = array_pop($path);

        $reflection = new self($object);
        foreach ($path as $property) {
            $reflection = new self($reflection->readProperty($property));
        }

        return array($reflection, $finalProperty);
    }

    /**
     * @param string $property
     * @return mixed
     */
    public function readProperty($property)
    {
        if ($this->hasPublicProperty($property)) {
            return $this->object->$property;
        }

        if ($getter = $this->getPublicGetter($property)) {
            return $this->object->$getter();
        }

        // todo: throw exception
    }

    /**
     * @param string $property
     * @param mixed $value
     * @return void
     */
    public function writeProperty($property, $value)
    {
        if ($this->hasPublicProperty($property)) {
            return $this->object->$property = $value;
        }

        if ($setter = $this->getPublicSetter($property)) {
            return $this->object->$setter($value);
        }

        // todo: throw exception
    }

    /**
     * @param bool $reverse
     * @return void
     */
    public function inspectClassNames($reverse = false)
    {
        $this->classes = array();
        $class = get_class($this->object);

        do {
            $classes = explode('\\', $class);
            $this->classes[] = array_pop($classes);
        } while (false !== $class = get_parent_class($class));
    }

    /**
     * @param bool $toUnderscore
     * @return array
     */
    public function getSubtypeNames($toUnderscore = false)
    {
        $classes = $this->classes;
        $type = array_pop($classes);
        $subtypes = array();

        foreach ($classes as $class) {
            $subtype = str_replace($type, '', $class);
            $subtypes[] = $toUnderscore ? $this->toUnderscore($subtype) : $subtype;
        }

        return $subtypes;
    }

    /**
     * @param string $property
     * @return bool
     */
    public function hasPublicProperty($property)
    {
        $r = new \ReflectionClass(get_class($this->object));

        return $r->hasProperty($property) && $r->getProperty($property)->isPublic();
    }

    /**
     * @param string $property
     * @return null|string
     */
    public function getPublicGetter($property)
    {
        return $this->getPublicAccessor('get', $property);
    }

    /**
     * @param string $property
     * @return null|string
     */
    public function getPublicSetter($property)
    {
        return $this->getPublicAccessor('set', $property);
    }

    /**
     * @param string $name
     * @return string
     */
    private function toUnderscore($name)
    {
        return strtolower(preg_replace(
                              array('/([A-Z]+)([A-Z][a-z])/', '/([a-z\d])([A-Z])/'),
                              array('\\1_\\2', '\\1_\\2'), strtr($name, '_', '.')
                          ));
    }

    /**
     * @param string $name
     * @return string
     */
    private function toCamelcase($name)
    {
        $final = '';

        foreach (explode('_', $name) as $part) {
            $final .= ucfirst($part);
        }

        return $final;
    }

    /**
     * @param string $prefix
     * @param string $property
     * @return null|string
     */
    private function getPublicAccessor($prefix, $property)
    {
        $m = $this->toCamelcase($prefix . ucfirst($property));
        $r = new \ReflectionClass(get_class($this->object));

        return ($r->hasMethod($m) && $r->getMethod($m)->isPublic()) ? $m : null;
    }
}
