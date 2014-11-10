<?php

    namespace MOMook\Propel\Behavior;

    use MOMook\Propel\Generator\Builder\Om\AbstractOMBuilder;
    use Propel\Generator\Model\Table;

    /**
     * Class ZfFormAnnotationBehaviorBuilder
     * @package MOMook\Propel\Behavior
     */
    class ZfFormAnnotationBehaviorBuilder extends AbstractOMBuilder
    {
        /**
         * @param Table $table
         *
         * @return ZfFormAnnotationBehaviorBuilder
         */
        public function __construct(Table $table)
        {
            parent::__construct($table);

            $this->setTemplateBasePath(__DIR__);
        }

        /**
         * @return string
         */
        public function getUnprefixedClassname()
        {
            return $this->getStubObjectBuilder()->getUnprefixedClassname() . 'Form';
        }

        /**
         * @param string $script
         */
        protected function addClassOpen(&$script)
        {
            $script .= $this->renderTemplate(
                'baseFormClassOpen',
                [
                    'className' => ucfirst($this->getTable()->getName()) . 'Form'
                ]
            );
        }

        /**
         * @param string $script
         */
        protected function addClassBody(&$script)
        {
            $script .= $this->renderTemplate('baseFormClassBody');
        }

        /**
         * @param string $script
         */
        protected function addClassClose(&$script)
        {
            $script .= $this->renderTemplate('baseFormClassClose');
        }
    }