<?php

    namespace MOMook\Propel\Behavior;

    use Propel\Generator\Builder\Om\AbstractOMBuilder;

    /**
     * Class ZfFormAnnotationBehaviorBuilder
     * @package MOMook\Propel\Behavior
     */
    class ZfFormAnnotationBehaviorBuilder extends AbstractOMBuilder
    {

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
            $table = $this->getTable();
            $tableName = $table->getName();
            $script .= "
/**
 * Test class for Additional builder enabled on the '$tableName' table.
 *
 */
class " . ucfirst($tableName) . "Form
{
";
        }

        /**
         * @param string $script
         */
        protected function addClassBody(&$script)
        {
            $table = $this->getTable();
            $columns = $table->getColumns();

            foreach ($columns as $column) {

                $script .= '
/**
 * @Annotation\Filter({"name":"StringTrim"})
 * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":255}})
 * @Annotation\Attributes({"type":"text"})
 * @Annotation\Options({"label":"Title:"})
 */
public $' . $column->getName() . ';
';
            }
        }

        /**
         * @param string $script
         */
        protected function addClassClose(&$script)
        {
            $script .= "
}";
        }
    }