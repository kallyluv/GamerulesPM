<?

namespace xjustjqy\gamerules\actions;
use xjustjqy\gamerules\Main;

use pocketmine\plugin\Plugin;
use pocketmine\Server;
use pocketmine\Player;

use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageEvent;

class InstantRespawn extends Action {
  
  public function __construct(Plugin $register) {
    $this->register($register);
    $this->addListener("EntityDamageEvent", "onDeath");
  }
  
  public function onDeath(EntityDamageEvent $event) {
    $player = $event->getEntity();
    if($this->isCancelled() && $player instanceof Player && !$event->isCancelled() && $event->getFinalDamage() >= ($player->getHealth() - 0.1)) {
      $event->setCancelled(true);
      $plugin = Main::fetch();
      $armor = null;
      $inv = null;
      if(!isset($plugin->gamerules["keepinventory"]) || !$plugin->gamerules["keepinventory"]) {
        $armor = $player->getArmorInventory()->getContents();
        $inv = $player->getInventory()->getContents();
      }
      $ev = new PlayerDeathEvent($player, []);
      $ev->call();
      $player->setHealth($player->getMaxHealth());
      $player->setFood($player->getMaxFood());
      if($armor !== null && is_array($armor)) {
        $player->getArmorInventory()->setContents($armor);
      }
      if($inv !== null && is_array($inv)) {
        $player->getInventory()->setContents($inv); 
      }
      $player->teleport($player->getSpawn());
    }
  }
  
}
