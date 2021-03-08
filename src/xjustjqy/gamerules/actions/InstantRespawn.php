<?

namespace xjustjqy\gamerules\actions;

use pocketmine\plugin\Plugin;
use pocketmine\Server;

use pocketmine\event\player\PlayerDeathEvent;

use pocketmine\network\mcpe\protocol\RespawnPacket;

class InstantRespawn extends Action {
  
  public function __construct(Plugin $register) {
    $this->register($register);
    $this->addListener("PlayerDeathEvent", "onDeath");
  }
  
  public function onDeath(PlayerDeathEvent $event) {
    if($this->isCancelled()) {
      $player = $event->getPlayer();
      $pk = new RespawnPacket();
      $pk->entityRuntimeId = $player->getId();
      $pk->position = Server::getInstance()->getDefaultLevel()->getSafeSpawn();
      $pk->readyState = 1;
      foreach(Server::getInstance()->getOnlinePlayers() as $p) {
        $p->dataPacket($pk); 
      }
    }
  }
  
}
