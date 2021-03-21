<?php
/* strategy pattern*/
/* 振る舞いを抽象化する*/
/* 振る舞いを交換可能にする*/
/* 振る舞いを独立する*/
/**
 * 不変な部分と変更する部分を明確化でき
 * 変更部分を切り出す場合
 */

interface FlyBehavior
{
    public function fly();
}

class RocketPowered implements FlyBehavior
{
    public function fly()
    {
        echo 'rocket dive';
    }
}

class NoneWings implements FlyBehavior
{
    public function fly()
    {
        echo 'cant fly';
    }
}

class Human
{
    private $flyBehavior;
    public function __construct(FlyBehavior $flyBehavior)
    {
        $this->flyBehavior = $flyBehavior;
    }
    
    public function showFly()
    {
        $this->flyBehavior->fly();
    }
}

$human = new Human(new NoneWings);
$human->showFly();
?>

