<?php
/* strategy pattern*/
/* Subject(配信者)とObserver(監視者)に分ける*/
/* Subjectの状態の変更は、SubjectがObserverに通知する*/
/* SubjectはObserverの具象実装に関与せず、Observerインターフェースに対しての実装を行う*/
/**
 * とあるオブジェクトが
 * 別のオブジェクトの状態変化を
 * 認知する必要がある場合
 */
interface Subject
{
    public function registerObserver(Observer $observer);
    public function removeObserver(Observer $observer);
    public function notifyObservers();
}

interface Observer
{
    public function update(float $tmp, float $humidity, float $pressure);
}

interface DisplayElement
{
    public function display();
}

class WeatherData implements Subject
{
    private $observers;
    private $humidity;
    private $temperature;
    private $pressure;

    public function __construct()
    {
        $this->observers = [];
    }

    /**
     * オブザーバー追加
     *
     * @param Observer $observer
     * @return void
     */
    public function registerObserver(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    /**
     * オブザーバー削除
     *
     * @param Observer $observer
     * @return void
     */
    public function removeObserver(Observer $observer)
    {
        $index = array_search($observer, $this->observers);
        unset($this->observers[$index]);
    }

    /**
     * オブザーバー通知
     *
     * @return void
     */
    public function notifyObservers()
    {
        foreach($this->observers as $observer) {
            $observer->update($this->temperature, $this->humidity, $this->pressure);
        }
    }

    /**
     * 気象観測所の更新を検知
     *
     * @return void
     */
    public function measurementsChanged()
    {
        /** */
        $this->notifyObservers();
    }

    public function setMeasurements(float $temperature, float $humidity, float $pressure)
    {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->measurementsChanged();
    }
}

class CurrentConditionsDisplay implements Observer, DisplayElement
{
    private $temperature;
    private $humidity;
    private $weatherData;

    public function __construct(WeatherData $weatherData)
    {
        $this->weatherData = $weatherData;
        $this->weatherData->registerObserver($this);
    }

    public function update(float $temperature, float $humidity, float $pressure)
    {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->display();
    }

    public function display()
    {
        print($this->temperature.$this->humidity);
    }
}

$subject = new WeatherData;
$observer1 = new CurrentConditionsDisplay($subject);
$observer2= new CurrentConditionsDisplay($subject);
$subject->setMeasurements(1.1, 2.2, 3.3);