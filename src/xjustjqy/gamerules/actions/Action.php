<?

namespace xjustjqy\gamerules\actions;

use pocketmine\event\Listener;
use pocketmine\plugin\Plugin;
use pocketmine\Server;

class Action implements Listener {
 
    /** @var bool */
    private $cancel = false;
 
    public function register(Plugin $register) {
       Server::getInstance()->getPluginManager()->registerEvents($this, $register);
    }
  
    public function isCancelled() {
      return $this->cancel; 
    }
  
    public function toggle(bool $which = false) {
      $this->cancel = $which; 
    }
  
}
