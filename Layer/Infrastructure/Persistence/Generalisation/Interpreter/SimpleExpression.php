<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\Interpreter;


class SimpleExpression implements ExpressionInterface
{
    protected $field;
    protected $operator;
    protected $value;

    public function __construct($field, $operator, $value)
    {
        $this->field = $field;
        $this->operator = $operator;
        $this->value = $value;
    }
    public function interpret()
    {
        return $this->field.' '.$this->operator.' '.$this->value;
    }
}
