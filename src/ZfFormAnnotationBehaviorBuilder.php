<?php

namespace MOMook\Propel\Behavior;

use Propel\Generator\Builder\Om\ExtensionObjectBuilder;

/**
 * Class ZfFormAnnotationBehaviorBuilder
 * @package MOMook\Propel\Behavior
 */
class ZfFormAnnotationBehaviorBuilder extends ExtensionObjectBuilder
{

    /**
     * Do not overwrite these stub classes if they already exist.
     */
    public $overwrite = false;

    /**
     * Returns the qualified (prefixed) classname that is being built by the current class.
     * This method must be implemented by child classes.
     *
     * @return string
     */
    public function getUnprefixedClassname()
    {
        return parent::getUnprefixedClassname() . 'Form';
    }

    /**
     * This declares the class use and returns the correct name to use (short classname, Alias, or FQCN)
     *
     * @param  AbstractOMBuilder $builder
     * @param  boolean           $fqcn    true to return the $fqcn classname
     * @return string            ClassName, Alias or FQCN
     */
    public function getClassNameFromBuilder($builder, $fqcn = false)
    {
        $suffix = 'Form';

        if ($fqcn) {
            return $builder->getFullyQualifiedClassName() . $suffix;
        }

        $namespace = $builder->getNamespace();
        $class = $builder->getUnqualifiedClassName() . $suffix;

        if (isset($this->declaredClasses[$namespace])
            && isset($this->declaredClasses[$namespace][$class])) {
            return $this->declaredClasses[$namespace][$class];
        }

        return $this->declareClassNamespace($class, $namespace, true);
    }

}
