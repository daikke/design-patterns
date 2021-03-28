<?php
/* command pattern*/
/* リクエストをカプセル化する*/
/* アンドゥ可能な操作を提供する*/
interface Command
{
    public function execute(): void;
    public function undo(): void;
}

class Light
{
    public function on(): void
    {
        var_dump('light on');
    }

    public function off(): void
    {
        var_dump('light off');
    }
}
class Stereo
{
    public function on(): void
    {
        var_dump('stereo on');
    }

    public function setCd(): void
    {
        var_dump('set CD');
    }

    public function play(): void
    {
        var_dump('singing');
    }

    public function stop(): void
    {
        var_dump('stopping');
    }

    public function off(): void
    {
        var_dump('stereo off');
    }
}

class LightOnCommand implements Command
{
    private $light;

    public function __construct(Light $light)
    {
        $this->light = $light;
    }

    public function execute(): void
    {
        $this->light->on();
    }

    public function undo(): void
    {
        $this->light->off();
    }
}

class LightOffCommand implements Command
{
    private $light;

    public function __construct(Light $light)
    {
        $this->light = $light;
    }

    public function execute(): void
    {
        $this->light->off();
    }

    public function undo(): void
    {
        $this->light->on();
    }
}

class StereoOnCommand implements Command
{
    private $stereo;

    public function __construct(Stereo $stereo)
    {
        $this->stereo = $stereo;
    }

    public function execute(): void
    {
        $this->stereo->on();
        $this->stereo->setCd();
        $this->stereo->play();
    }

    public function undo(): void
    {
        $this->stereo->stop();
        $this->stereo->off();
    }
}

class StereoOffCommand implements Command
{
    private $stereo;

    public function __construct(Stereo $stereo)
    {
        $this->stereo = $stereo;
    }

    public function execute(): void
    {
        $this->stereo->stop();
        $this->stereo->off();
    }

    public function undo(): void
    {
        $this->stereo->on();
        $this->stereo->setCd();
        $this->stereo->play();
    }
}

class NoCommand implements Command
{
    public function execute(): void {}
    public function undo(): void {}
}

class RemoteControl
{
    private array $onCommands = [];
    private array $offCommands = [];
    private Command $undoCommand;

    public function __construct()
    {
        for ($slot = 0; $slot < 7; $slot++) {
            $this->onCommands[$slot] = new NoCommand;
            $this->offCommands[$slot] = new NoCommand;
        }
        $this->undoCommand = new NoCommand;
    }

    public function setCommand(int $slot, Command $onCommand, Command $offCommand): void
    {
        $this->onCommands[$slot] = $onCommand;
        $this->offCommands[$slot] = $offCommand;
    }

    public function onButtonWasPushed(int $slot): void
    {
        $this->onCommands[$slot]->execute();
        $this->undoCommand = $this->onCommands[$slot];
    }

    public function offButtonWasPushed(int $slot): void
    {
        $this->offCommands[$slot]->execute();
        $this->undoCommand = $this->offCommands[$slot];
    }

    public function undoButtonWasPushed(): void
    {
        $this->undoCommand->undo();
    }

}

$light = new Light;
$lightOnCommand = new LightOnCommand($light);
$lightOffCommand = new LightOffCommand($light);

$stereo = new Stereo;
$stereoOnCommand = new StereoOnCommand($stereo);
$stereoOffCommand = new StereoOffCommand($stereo);


$remoteControl = new RemoteControl();
$remoteControl->setCommand(0, $lightOnCommand, $lightOffCommand);
$remoteControl->setCommand(1, $stereoOnCommand, $stereoOffCommand);


$remoteControl->onButtonWasPushed(0);
$remoteControl->onButtonWasPushed(1);
$remoteControl->offButtonWasPushed(0);
$remoteControl->offButtonWasPushed(1);
$remoteControl->undoButtonWasPushed();