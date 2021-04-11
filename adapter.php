<?php
/* adapter pattern*/
/* クラスのインターフェースを別のインターフェースに変換する*/
/* クライアント（呼び出し側）はアダプティ（呼び出される方）を何もしらない*/
/* アダプタは既存のクラスと同様の振る舞いをアダプティに可能にさせる*/
/**
 * 互換性のないインターフェースのために
 * そのままでは連携できないクラスを連携させる。
 */

interface Duck
{
    public function quack(): void;
    public function fly(): void;
}

class MallardDuck implements Duck
{
    public function quack(): void
    {
        echo 'ガーガー';
    }

    public function fly(): void
    {
        echo '飛んでいます';
    }
}

interface Turkey
{
    public function gobble(): void;
    public function fly(): void;
}

class WildTurkey implements Turkey
{
    public function gobble(): void
    {
        echo 'ゴロゴロ';
    }

    public function fly(): void
    {
        echo '飛んでいます';
    }
}

// Duckを具象実装した、ターキーアダプターを作成
class TurkeyAdapter implements Duck
{
    private Turkey $turkey;

    public function __construct(Turkey $turkey)
    {
        $this->turkey = $turkey;
    }

    // Duckの振る舞いと同様のTurkeyの振る舞いをよびだす
    public function quack(): void
    {
        $this->turkey->gobble();
    }

    public function fly(): void
    {
        $this->turkey->fly();
    }
}

class DuckAdapter implements Turkey
{
    private Duck $duck;

    public function __construct(Duck $duck)
    {
        $this->duck = $duck;
    }

    // turkeyの振る舞いと同様のduckの振る舞いをよびだす
    public function gobble(): void
    {
        $this->duck->quack();
    }

    public function fly(): void
    {
        $this->duck->fly();
    }
}
$wildTurkey = new WildTurkey;
$wildTurkey->gobble();
$wildTurkey->fly();

$turkeyAdapter = new TurkeyAdapter($wildTurkey);

$turkeyAdapter->quack();
$turkeyAdapter->fly();