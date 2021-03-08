<?

namespace xjustjqy\gamerules\actions;

use pocketmine\plugin\Plugin;
use pocketmine\Server;

use pocketmine\event\block\BlockBreakEvent;

class TileDrops extends Action {
 
  public function __construct(Plugin $register) {
    $this->register($register);
    $this->addListener("BlockBreakEvent", "onBlockBreak");
  }
  
  public function onBlockBreak(BlockBreakEvent $event) {
    if($this->isCancelled()) {
      $event->setDrops([]); 
    }
  }
  
}
