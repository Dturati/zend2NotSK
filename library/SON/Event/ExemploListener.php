<?php
namespace SON\Event;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManager;


class ExemploListener implements  ListenerAggregateInterface
{
    protected $listeners = array();

    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach('multiplosEventos.pre',array($this,'executaPre'),100);
        $this->listeners[] = $events->attach('multiplosEventos.post',array($this,'executaPost'),99);
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $k=>$listeners){
            if($events->detach($listeners)){
                unset($this->listeners[$k]);
            }
        }
    }

    public function executaPre()
    {
        echo "Executa pre<br>";
    }

    public function executaPost()
    {
        echo "Executa post<br>";
    }

}