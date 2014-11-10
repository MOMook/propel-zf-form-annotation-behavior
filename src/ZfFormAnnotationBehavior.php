<?php

    namespace MOMook\Propel\Behavior;

    use Propel\Generator\Model\Behavior;

    /**
     * Class ZfFormAnnotationBehavior
     * @package MOMook\Propel\Behavior
     */
    class ZfFormAnnotationBehavior extends Behavior
    {

        /**
         * @var array
         */
        protected $additionalBuilders = [
            'MOMook\Propel\Behavior\ZfFormAnnotationBehaviorBaseBuilder',
            'MOMook\Propel\Behavior\ZfFormAnnotationBehaviorBuilder',
        ];

    }
