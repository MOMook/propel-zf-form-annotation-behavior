<?php

    namespace MOMook\Propel\Behavior;

    use Propel\Generator\Model\Behavior;

    /**
     * Class ZfFormAnnotationBehavior
     * @package MOMook\Propel\Behavior
     */
    class ZfFormAnnotationBehavior extends Behavior
    {
        protected $additionalBuilders = array('MOMook\Propel\Behavior\ZfFormAnnotationBehaviorBuilder');
    }