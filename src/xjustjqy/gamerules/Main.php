<?

namespace xjustjqy\gamerules;

use pocketmine\plugin\PluginBase;
use xjustjqy\gamerules\commands\GameruleCommand;

class Main extends PluginBase {
  
  private static $instance;
  
 public function onEnable() {
    self::$instance = $this;
    $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
    $this->getServer()->getCommandMap()->registerAll("gamerulespm", [
      new GameruleCommand()
    ]);
 }
  
  public static function fetch(): ?self {
    return self::$instance;
  }
  
}
