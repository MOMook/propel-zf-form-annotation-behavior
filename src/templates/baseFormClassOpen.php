
    use Zend\Form\Annotation;
    use Zend\Form\Annotation\AnnotationBuilder;

    /**
     * @Annotation\Name("<?php echo $className; ?>")
     * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
     */
    class <?php echo $className; ?>

    {

        /**
         * @return \Zend\Form\Form
         */
        public static function build()
        {
            $builder = new AnnotationBuilder();
            $form    = $builder->createForm(new self);

            return $form;
        }
