<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation\Interpreter;

class AndExpression implements ExpressionInterface
{
    protected $exp1;
    protected $exp2;

    public function __construct(ExpressionInterface $exp1, ExpressionInterface $exp2)
    {
        $this->exp1 = $exp1;
        $this->exp2 = $exp2;
    }

    public function interpret()
    {
        return '('.$this->exp1->interpret().' AND '.$this->exp2->interpret().')';
    }
}