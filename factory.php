<?php
/**
 * インスタンス化を具象実装から切り離す
 */
interface Pizza {}

class CheesePizza implements Pizza {}
class GreekPizza implements Pizza {}
class PepperoniPizza implements Pizza {}
class VeggiePizza implements Pizza {}
class ClamPizza implements Pizza {}
class ChicagoStyleCheesePizza implements Pizza {}
class ChicagoStyleGreekPizza implements Pizza {}
class ChicagoStylePepperoniPizza implements Pizza {}
class CaliforniaStyleCheesePizza implements Pizza {}
class CaliforniaStyleGreekPizza implements Pizza {}
class CaliforniaStylePepperoniPizza implements Pizza {}

class OrderPizza
{
    private Pizza $pizza;

    public function __construct(String $type)
    {
        /**
         * 以下の分岐は変更する必要が多くある
         */
        if ($type === 'cheese') {
            $this->pizza = new CheesePizza;
        } elseif ($type === 'greek') {
            $this->pizza = new GreekPizza;
        }elseif ($type === 'pepperoni') {
            $this->pizza = new PepperoniPizza;
        }
        /**
         * 変更は隔離するため切り出す
         */
    }

    public function __invoke()
    {
        $this->prepare();
        $this->bake();
        $this->cut();
        $this->box();
        return $this->pizza;
    }

    private function prepare() {}
    private function bake() {}
    private function cut() {}
    private function box() {}
}

/**
 * 分岐をFactoryに隔離
 */
class PizzaFactory
{
    public static function createPizza(String $type): Pizza
    {
        if ($type === 'cheese') {
            $pizza = new CheesePizza;
        } elseif ($type === 'greek') {
            $pizza = new GreekPizza;
        }elseif ($type === 'pepperoni') {
            $pizza = new PepperoniPizza;
        }

        return $pizza;
    }
}

/**
 * factoryにピザの内容を隔離したことで、Pizzaインターフェースへのプログラミングが可能に
 */
class OrderPizza
{
    private Pizza $pizza;

    public function __construct(String $type)
    {
        $this->pizza = PizzaFactory::createPizza($type);
    }

    public function __invoke()
    {
        $this->prepare();
        $this->bake();
        $this->cut();
        $this->box();
        return $this->pizza;
    }

    private function prepare() {}
    private function bake() {}
    private function cut() {}
    private function box() {}
}



/**
 * このままだと、ピザのメニューを店ごとに返れない
 * もっと柔軟性を持たせてみる
 */

abstract class PizzaStore
{
    private Pizza $pizza;

    public function __construct(String $type)
    {
        $this->pizza = $this->createPizza($type);
    }

    public function order()
    {
        $this->prepare();
        $this->bake();
        $this->cut();
        $this->box();
        return $this->pizza;
    }

    private function prepare() {}
    private function bake() {}
    private function cut() {}
    private function box() {}

    protected function createPizza(String $type): Pizza {}
}

class NYStore extends PizzaStore
{
    /**
     * ファクトリーの分岐部分をサブクラスに移管
     * そうすることで、具象実装ごとに柔軟性を持たせられる
     *
     * @param String $type
     * @return Pizza
     */
    protected function createPizza(String $type): Pizza
    {
        if ($type === 'cheese') {
            $pizza = new CheesePizza;
        } elseif ($type === 'greek') {
            $pizza = new GreekPizza;
        } elseif ($type === 'pepperoni') {
            $pizza = new PepperoniPizza;
        }

        return $pizza;
    }
}

class SSStore extends PizzaStore
{
    /**
     * ファクトリーの分岐部分をサブクラスに移管
     * そうすることで、具象実装ごとに柔軟性を持たせられる
     *
     * @param String $type
     * @return Pizza
     */
    protected function createPizza(String $type): Pizza
    {
        if ($type === 'veggie') {
            $pizza = new VeggiePizza;
        } elseif ($type === 'clam') {
            $pizza = new ClamPizza;
        }

        return $pizza;
    }
}

class ChicagoStyleStore extends PizzaStore
{
    /**
     * ファクトリーの分岐部分をサブクラスに移管
     * そうすることで、具象実装ごとに柔軟性を持たせられる
     *
     * @param String $type
     * @return Pizza
     */
    protected function createPizza(String $type): Pizza
    {
        if ($type === 'cheese') {
            $pizza = new ChicagoStyleCheesePizza;
        } elseif ($type === 'greek') {
            $pizza = new ChicagoStyleGreekPizza;
        } elseif ($type === 'pepperoni') {
            $pizza = new ChicagoStylePepperoniPizza;
        }

        return $pizza;
    }
}

class CaliforniaStyleStore extends PizzaStore
{
    /**
     * ファクトリーの分岐部分をサブクラスに移管
     * そうすることで、具象実装ごとに柔軟性を持たせられる
     *
     * @param String $type
     * @return Pizza
     */
    protected function createPizza(String $type): Pizza
    {
        if ($type === 'cheese') {
            $pizza = new CaliforniaStyleCheesePizza;
        } elseif ($type === 'greek') {
            $pizza = new CaliforniaStyleGreekPizza;
        } elseif ($type === 'pepperoni') {
            $pizza = new CaliforniaStylePepperoniPizza;
        }

        return $pizza;
    }
}

new CaliforniaStyleStore('cheese');
new ChicagoStyleStore('cheese');

