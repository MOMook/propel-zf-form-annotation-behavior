<?php foreach ($behavior->getTable()->getColumns() as $column): ?>
<?php
    // TODO: make this configurable
    if ($column->isAutoIncrement()) {
        continue;
    }
    // TODO: make this configurable, perhaps allow outputing a drop-down list or something.
    if ($column->isForeignKey()) {
        continue;
    }
    $annotations = [
        'Attributes' => [],
        'Filters' => [],
        'Options' => [],
        'Validators' => [],
    ];

    $propelType = strtoupper($column->getType());

    $defaultValue = $column->hasDefaultValue() ? $column->getDefaultValue()->getValue() : null;

    if ($column->isBooleanType()) {
        $zendType = 'Checkbox';
        $value = 1;
        if ($defaultValue === 'true') {
            $annotations['Attributes']['checked'] = true;
        }
    } elseif ($column->isTemporalType()) {
        switch($propelType) {
            case 'DATE':
                $zendType = 'Date';
                break;
            case 'TIME':
                $zendType = 'Time';
                break;
            default:
                $zendType = 'DateTime';
                break;
        }
    } elseif ($column->isNumericType()) {
        $zendType = 'Number';

        $size = (int)$column->getSize();
        $scale = (int)$column->getScale();

        $min = $max = null;
        if ($size > 0) {
            if ($scale > 0) {
                $max = (float)(str_repeat('9', $size - $scale) . '.' . str_repeat('9', $scale));
            } else {
                $max = (int)str_repeat('9', $size);
            }
            $min = -$max;
        }

        $sqlType = $column->getDomain()->getSqlType();
        if (stripos($sqlType, 'UNSIGNED') !== false) {
            $min = 0;
        }

        if (!is_null($max)) {
            $annotations['Attributes']['max'] = $max;
        }
        if (!is_null($min)) {
            $annotations['Attributes']['min'] = -$max;
        }

        if ($scale > 0) {
            $annotations['Attributes']['step'] = pow(10, -$scale);
        }
    } else { // default to string type
        switch($propelType) {
            case 'LONGVARCHAR':
                $zendType = 'Textarea';
                break;
            default:
                $zendType = 'Text';
                break;
        }

        $size = (int)$column->getSize();
        if ($size > 0) {
            $annotations['Attributes']['maxlength'] = $size;
            $annotations['Validators'][] = [
                'name' => 'StringLength',
                'options' => ['max' => $size, 'min' => 1],
            ];
        }

        // TODO: check the trim_strings pref before using this filter
        $annotations['Filters'][] = [
            'name' => 'StringTrim',
        ];
    }

    $annotations['Type'] = $zendType;

    if (!$column->isBooleanType() && ($defaultValue !== 'null')) {
        $annotations['Attributes']['value'] = $defaultValue;
        $annotations['Attributes']['placeholder'] = $defaultValue;
    }

    if ($column->isNotNull()) {
        $annotations['Required']['required'] = true;
    }

    $annotations['Options']['label'] = $column->getPhpName();
    ?>

        /**
<?php if (!empty($annotations['Attributes'])): ?>
         * @Annotation\Attributes(<?php echo json_encode($annotations['Attributes']); ?>)
<?php endif; ?>
<?php if (!empty($annotations['Filter'])): ?>
<?php foreach ($annotations['Filters'] as $filter): ?>
         * @Annotation\Filter(<?php echo json_encode($filter); ?>)
<?php endforeach; ?>
<?php endif; ?>
<?php if (!empty($annotations['Options'])): ?>
         * @Annotation\Options(<?php echo json_encode($annotations['Options']); ?>)
<?php endif; ?>
<?php if (!empty($annotations['Required'])): ?>
         * @Annotation\Required(<?php echo json_encode($annotations['Required']); ?>)
<?php endif; ?>
<?php if (!empty($annotations['Type'])): ?>
         * @Annotation\Type("Zend\Form\Element\<?php echo $annotations['Type']; ?>")
<?php endif; ?>
<?php if (!empty($annotations['Validators'])): ?>
<?php foreach ($annotations['Validators'] as $validator): ?>
         * @Annotation\Validator(<?php echo json_encode($validator); ?>)
<?php endforeach; ?>
<?php endif; ?>
         */
        public $<?php echo $column->getName(); ?>;
<?php endforeach; ?>
