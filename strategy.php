<?php
/* strategy patern*/
/* 振る舞いを抽象化する*/
/* 振る舞いを交換可能にする*/
/* 振る舞いを独立する*/

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

