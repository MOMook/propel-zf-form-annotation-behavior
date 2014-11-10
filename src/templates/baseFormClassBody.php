    <?php foreach ($behavior->getTable()->getColumns() as $column): ?>

        /**
         * @Annotation\Filter({"name":"StringTrim"})
         * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":255}})
         * @Annotation\Attributes({"type":"text"})
         * @Annotation\Options({"label":"Title:"})
        */
        public $<?php echo $column->getName(); ?>;
    <?php endforeach; ?>