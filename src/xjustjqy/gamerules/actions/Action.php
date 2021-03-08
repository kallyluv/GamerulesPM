<?

namespace xjustjqy\gamerules\actions;

use pocketmine\event\Listener;
use pocketmine\plugin\Plugin;
use pocketmine\Server;

use pocketmine\event\Event;

class Action implements Listener {
 
    /** @var bool */
    private $cancel = false;
    /** @var array */
    private $listners = [];
 
    public function register(Plugin $register) {
       Server::getInstance()->getPluginManager()->registerEvents($this, $register);
    }
 
    public function addListener($listener, $callback) {
      if(!isset($this->listeners[$listener])) $this->listeners[$listener] = [];
      $this->listeners[$listener][] = $callback;
    }
 
    public function onEvent(Event $event) {
      $name = $event->getEventName();
      if(is_null($name)) return;
      foreach($this->listeners[$name] as $callback) {
        $this->{$callback}($event);
      }
    }
  
    public function isCancelled() {
      return $this->cancel; 
    }
  
    public function toggle(bool $which = false) {
      $this->cancel = $which; 
    }
  
}
