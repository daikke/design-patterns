<?php
/* singleton pattern*/
/* 自分のインスタンスを自己生成する*/
/* 他のクラスからはインスタンス化されない*/
/* 該当クラスの唯一性がたもたれる*/
/**
 * 複数のインスタンスから単一のインスタンスへの利用が行われる場合
 */
class Singleton
{
    // 唯一性のあるクラスのインスタンス
    private static $uniqueInstance;
    public string $keyword = 'test1';

    // privateでコンストラクタが定義されているため,Singletonクラスのみが、Singletonクラスをインスタンス化できる。
    private function __construct() {
        echo 'constructed';
    }

    public static function getInstance(): Singleton
    {
        if (self::$uniqueInstance === null) {
            self::$uniqueInstance = new Singleton();
        }

        return self::$uniqueInstance;
    }
}

$singleton1 = Singleton::getInstance();
$singleton2 = Singleton::getInstance();
var_dump($singleton1->keyword);
var_dump($singleton2->keyword);

// $singleton1のプロパティのみを変更しているように見えるが、$singleton1,2は同一のインスタンスのため、状態が共有される。
$singleton1->keyword = 'test2';
var_dump($singleton1->keyword);
var_dump($singleton2->keyword);
var_dump($singleton1 === $singleton2);