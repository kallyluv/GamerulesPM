<?

namespace xjustjqy\gamerules\actions;

use xjustjqy\gamerules\Main;

use pocketmine\plugin\Plugin;
use pocketmine\Server;

use pocketmine\scheduler\ClosureTask;

use Closure;

function setInterval(Closure $callback, int $delay) {
  Main::fetch()->getScheduler()->scheduleRepeatingTask($task = new ClosureTask($callback), $delay);
  return $task->getTaskId();
}

function stopInterval(int $id) {
  Main::fetch()->getScheduler()->cancelTask($id); 
}

class DaylightCycle extends Action {
  
    /** @var Plugin */
    private $plugin;

    private $lastTime = null;
 
    public function __construct(Plugin $register) {
      $this->register($register); 
      $this->plugin = $register;
      setInterval(function() {
        if(!$this->isCancelled()) return;
        $level = Server::getInstance()->getDefaultLevel();
        $time = $level->getTime();
        if(is_null($this->lastTime)) $this->lastTime = $time;
        foreach(Server::getInstance()->getLevels() as $level) {
          $time = $level->getTime();
          if($this->lastTime !== $time) {
            $level->setTime($time);
          }
        }
      }, 20);
    }
  
}
