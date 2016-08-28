<?php
namespace SON\Event;

use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;

class Exemplo implements EventManagerAwareInterface
{

  protected $events;

  public function setEventManager(EventManagerInterface $events)
  {
      $events->setIdentifiers(array(
        __CLASS__,
        get_called_class()
      ));
      $this->events = $events;
      return $this;
  }

  public function getEventManager()
  {
    if(null == $this->events){
      $this->setEventManager(new EventManager());
    }

    return $this->events;
  }

  public function teste()
  {
    echo "teste";
  }

  public function metodo($valor)
  {
    echo "Metodo executou";
    //Gatilho
    $this->getEventManager()->trigger(
      __FUNCTION__,
      $this,
      array('valor' => $valor)
    );
  }

  public function metodo2()
  {
    //Gatilho
    $this->getEventManager()->trigger(
      __FUNCTION__,
      $this,
      array('valor' => "valor qualquer")
    );
  }

  public function metodo3($valor)
  {
    //Gatilho
    $arg = compact('valor');
    $results = $this->getEventManager()->triggerUntil(
              __FUNCTION__,
              $this,
              $arg,
              function ($v) use ($valor) {
                if ($valor == 1) {
                  return true;
                }
              }
    );

    if($results->stopped()) {
        echo "parrou a execução";
        return $results->last();
    }

    echo "Continua execução...";
  }

  public function multiplosEventos($valor)
  {
    //Gatilho
    $this->getEventManager()->trigger(
        __FUNCTION__.'.pre',
        $this,
        array('valor' => $valor)
    );
    echo "conteudo do metodo sendo executado";
    //Gatilho
    $this->getEventManager()->trigger(
        __FUNCTION__.'.post',
        $this,
        array('valor' => $valor)
    );
  }

}
