<?php
/* composite pattern*/
/* オブジェクトに付加的な責務を動的に付与する*/
/* 柔軟な拡張手段をえる*/

use Ramsey\Uuid\Exception\UnsupportedOperationException;

/**
 * インスタンスが動的に責務が増えるような場合
 */

abstract class MenuComponent
{
    public function add(MenuComponent $menuComponent): void
    {
        throw new UnsupportedOperationException();
    }

    public function remove(int $i): void
    {
        throw new UnsupportedOperationException();
    }

    public function getChild(int $i): MenuComponent
    {
        throw new UnsupportedOperationException();
    }

    public function getName(): string
    {
        throw new UnsupportedOperationException();
    }

    public function getDescription(): string
    {
        throw new UnsupportedOperationException();
    }

    public function getPrice(): float
    {
        throw new UnsupportedOperationException();
    }

    public function isVegetarian(): boolean
    {
        throw new UnsupportedOperationException();
    }

    public function print(): void
    {
        throw new UnsupportedOperationException();
    }

    public function createIterator(): Iterator
    {
        throw new UnsupportedOperationException();
    }
}

class MenuItem extends MenuComponent
{

    private string $name;
    private string $description;
    private boolean $vegetarian;
    private float $price;

    public function __construct(string $name, string $description, boolean $vegetarian, float $price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->vegetarian = $vegetarian;
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function isVegetarian(): boolean
    {
        return $this->vegetarian;
    }

    public function print(): void
    {
        echo $this->name;
        if ($this->isVegetarian()) {
            echo '(v)';
        }
        echo ',' . $this->getPrice();
        echo '--' . $this->getDescription();
    }

    public function createIterator(): Iterator
    {
        return new Iterator;
    }
}

class Menu extends MenuComponent
{

    private MenuComponents $menuComponents = new MenuComponents();
    private string $name;
    private string $description;

    public function __construct(string $name, string $description, boolean $vegetarian, float $price)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public function add(MenuComponent $menuComponent): void
    {
        $this->menuComponents->add($menuComponent);
    }

    public function remove(int $i): void
    {
        unset($this->menuComponents[$i]);
    }

    public function getChild(int $i): MenuComponent
    {
        return $this->menuComponents->remove($i);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function print(): void
    {
        echo $this->name;
        if ($this->isVegetarian()) {
            echo '(v)';
        }
        echo ',' . $this->getPrice();
        echo '--' . $this->getDescription();

        $iterator = $this->menuComponents->getIterator();
        while ($iterator->hasNext()) {
            echo $iterator->next();
        }
    }

    public function createIterator(): Iterator
    {
        return new Iterator;
    }
}