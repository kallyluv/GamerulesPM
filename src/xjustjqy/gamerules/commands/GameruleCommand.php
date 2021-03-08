<?

namespace xjustjqy\gamerules\commands;

use xjustjqy\gamerules\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as TF;

class GameruleCommand extends Command {
  
  private $actions = [];
 
  public function __construct() {
    parent::__construct("gamerule", "Change gamerules!", "/gamerule <rule> <value(s)>", []);
    $this->setDescription("Change gamerules!");
    $this->setPermission("pocketmine.command.gamerule");
    $path = "xjustjqy\\gamerules\\actions\\";
    $this->actions = [
      "falldamage" => new ($path . "FallDamage")(Main::fetch()),
      "keepinventory" => new ($path . "KeepInventory")(Main::fetch()),
      "dodaylightcycle" => new ($path . "DaylighCycle")(Main::fetch()),
      "doimmediaterespawn" => new ($path . "InstantRespawn")(Main::fetch()),
      "dotiledrops" => new ($path . "TileDrops")(Main::fetch()),
      "doweathercycle" => new ($path . "WeatherCycle")(Main::fetch()),
      "drowningdamage" => new ($path . "DrownDamage")(Main::fetch()),
      "firedamage" => new ($path . "FireDamage")(Main::fetch())
      "logadmincommands" => new ($path . "CommandLogger")(Main::fetch()),
      "naturalregeneration" => new ($path . "NaturalRegen")(Main::fetch()),
      "pvp" => new ($path . "PvP")(Main::fetch()),
      "showcoordinates" => new ($path . "ShowCoordinates")(Main::fetch()),
      "showdeathmessages" => new ($path . "ShowDeathMessages")(Main::fetch()),
      "tntexplodes" => new ($path . "Explosions")(Main::fetch())
    ];
  }
  
  
  public function execute(CommandSender $sender, string $label, array $args) : bool {
    if(!$this->testPermission($sender)) {
      $sender->sendMessage(TF::RED . "You do not have permission to use this command!"); 
      return true;
    }
    if(count($args) < 2) return false;
    if(!in_array(strtolower($args[0]), array_keys($this->actions)) {
      $sender->sendMessage(TF::RED . "That gamerule doesn't exist!");
      return true;
    }
    $action = $this->actions[strtolower($args[0])];
    if(strtolower($args[1]) === "true") $args[1] = true;
    elseif(strtolower($args[1]) === "false") $args[1] = false;
    else {
      $sender->sendMessage(TF::RED . "That value is not accepted!");
      $sender->sendMessage("Usage: /gamerule " . strtolower($args[0]) . " <true|false>");
      return true;
    }
    $action->toggle($args[1]);
  }
  
}
