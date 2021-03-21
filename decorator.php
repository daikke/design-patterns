<?php
/* decorator pattern*/
/* オブジェクトに付加的な責務を動的に付与する*/
/* 柔軟な拡張手段をえる*/
/**
 * インスタンスが動的に責務が増えるような場合
 */
interface AbstractBeverage
{
    public function getDescription(): string;
    public function cost(): float;
}

interface CondimentDecorator extends AbstractBeverage
{

}

class Espresso implements AbstractBeverage
{
    protected $description;

    public function __construct()
    {
        $this->description = 'エスプレッソ';
    }

    public function cost(): float
    {
        return .89;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}

class Mocha implements CondimentDecorator
{
    private $beverage;
    private $description = 'モカ';

    public function __construct(AbstractBeverage $beverage)
    {
        $this->beverage = $beverage;
    }

    public function getDescription(): string
    {
        return $this->beverage->getDescription() . $this->description;
    }

    public function cost(): float
    {
        return .20 + $this->beverage->cost();
    }
}

$beverage = new Espresso;
$beverage = new Mocha($beverage);
$beverage = new Mocha($beverage);
$beverage = new Mocha($beverage);
$beverage = new Mocha($beverage);
$beverage = new Mocha($beverage);

echo $beverage->cost();
echo $beverage->getDescription();