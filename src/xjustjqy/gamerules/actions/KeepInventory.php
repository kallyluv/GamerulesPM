<?

namespace xjustjqy\gamerules\actions;

use pocketmine\plugin\Plugin;
use pocketmine\Server;

use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerRespawnEvent;

class KeepInventory extends Action {
 
    public function __construct(Plugin $register) {
       $this->register($register);
       $this->addListener("PlayerDeathEvent", "onDeath");
    }
  
    public function onDeath(PlayerDeathEvent $event) {
      if($this->isCancelled()) {
        $inv = $event->getPlayer()->getInventory->getContents();
        $armor = $event->getPlayer()->getArmorInventory()->getContents();
        $event->setDrops([]);
        $this->addListener("PlayerRespawnEvent", function(PlayerRespawnEvent $ev) use ($inv, $armor, $event) {
           $player = $ev->getPlayer();
           if($player->getXuid() === $event->getPlayer()->getXuid()) {
              $player->getInventory()->setContents($inv);
              $player->getArmorInventory()->setContents($armor);
              $this->removeListener("PlayerRespawnEvent");
           }
        });
      }
    }
  
}
