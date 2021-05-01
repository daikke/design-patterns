<?php

interface iterator
{
    public function hasNext(): boolean;
    public function next(): object;
}

class DinnerMenuIterator implements Iterator
{
    private array $items;
    private int $position = 0;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function next(): object
    {
        $menuItem = $this->items[$this->$position];
        $this->position++;
        return $menuItem;
    }

    public function hasNext(): boolean
    {
        if (!isset($this->items[$this->position])) {
            return false;
        }

        return true;
    }
}


class BreakfastMenuIterator implements Iterator
{
    private object $items;
    private int $position = 0;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function next(): object
    {
        $menuItem = $this->items->{$this->$position};
        $this->position++;
        return $menuItem;
    }

    public function hasNext(): boolean
    {
        if (!isset($this->items->{$this->position})) {
            return false;
        }

        return true;
    }
}


class Waitress
{
    private object $dinnerMenu;
    private object $breakfastMenu;

    public function __construct(object $dinnerMenu, object $breakfastMenu)
    {
        $this->dinnerMenu = $dinnerMenu;
        $this->breakfastMenu = $breakfastMenu;
    }

    public function printMenu(): void
    {
        $breakfastIterator = $breakfastMenu->createIterator();
        $dinnerIterator = $dinnerMenu->createIterator();
        $this->Items($breakfastIterator);
        $this->Items($dinnerIterator);
    }

    public function printItems($iterator): void
    {
        while($iterator->hasNext()) {
            print($this->next());
        }
    }
}
