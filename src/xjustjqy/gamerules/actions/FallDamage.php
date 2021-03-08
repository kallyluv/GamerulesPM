<?

namespace xjustjqy\gamerules\actions;

use pocketmine\plugin\Plugin;
use pocketmine\Server;

use pocketmine\event\entity\EntityDamageEvent;

class FallDamage extends Action {
    
    /** @var bool */
    private $cancel = false;
 
    public function __construct(Plugin $register) {
       $this->register($register);
       $this->addListener("EntityDamageEvent", "onDamage");
    }
  
    public function onDamage(EntityDamageEvent $event) {
      if($event->getCause() === EntityDamageEvent::CAUSE_FALL && $this->cancel) $event->setCancelled($this->cancel);
    }
  
    public function toggle(bool $which = false) {
      $this->cancel = $which; 
    }
  
}
