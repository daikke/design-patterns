<?php
/* template pattern*/
/* アルゴリズムを*/
/* 固定化して*/
/* 具象クラスに処理を任せる*/
/**
 * 手順自体をサブクラスに先送りにし
 * アルゴリズムのある手順をサブクラスに再定義させる
 */

abstract class CaffeinBeverage
{

    final public function prepareRecipe(): void
    {
        $this->boilWater();
        $this->brew();
        $this->pourInCup();
        if ($this->customerWantsCondiments()) {
            $this->addCondiments();
        }
    }

    public function boilWater(): void
    {
        print('湯沸かし');
    }

    public function pourInCup(): void
    {
        print('カップに注ぎます');
    }

    public function customerWantsCondiments(): boolean
    {
        return true;
    }

    abstract public function brew();

    abstract public function addCondiments();
}


class Coffee extends CaffeinBeverage
{
    public function brew(): void
    {
        print('コーヒーをドリップします');
    }

    public function addCondiments(): void
    {
        print('砂糖とミルクを追加します');
    }
}

class Tea extends CaffeinBeverage
{
    public function brew(): void
    {
        print('紅茶を浸します');
    }

    public function addCondiments(): void
    {
        print('レモンを追加します');
    }
}