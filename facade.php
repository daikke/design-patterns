<?php
/* facade pattern*/
/* 複雑なサブシステムを取り出し１つのインターフェースにまとめる*/
/* サブシステムに対する簡素化されたインターフェースを提供する*/
/* 使いやすいインターフェースの提供*/
/**
 * 複数のサブシステムが絡み合ったパターンに
 * 簡潔なインターフェースを提供する場合
 */

class HomeTheaterFacade
{
    private Amplifier $amp;
    private Tuner $tuner;
    private DvdPlayer $dvd;
    private CdPlayer $cd;
    private Projector $projector;
    private TheaterLights $theaterLights;

    public function __construct(
        Amplifier $amp,
        Tuner $tuner,
        DvdPlayer $dvd,
        CdPlayer $cd,
        Projector $projector,
        TheaterLights $theaterLights)
        {
            $this->amp = $amp;
            $this->tuner = $tuner;
            $this->dvd = $dvd;
            $this->cd = $cd;
            $this->projector = $projector;
            $this->theaterLights = $theaterLights;
        }

    public function watchMovie(string $movie)
    {
        $this->theaterLights->dim(10);
        $this->screen->down();
        $this->projector->on();
        $this->projector->wideScreen();
        $this->amp->on();
        $this->amp->setDvd($this->dvd);
        $this->amp->setSurround(¥);
        $this->amp->setVolume(5);
        $this->dvd->on();
        $this->dvd->play();
    }


    public function endMovie()
    {
        $this->theaterLights->off();
        $this->screen->up();
        $this->projector->off();
        $this->amp->off();
        $this->dvd->stop();
        $this->dvd->eject();
        $this->dvd->off();
    }
}