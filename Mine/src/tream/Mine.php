<?php 

namespace tream;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;
use pocketmine\level\Level;
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\Config;
use pocketmine\level\Position;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;

class Mine extends PluginBase implements Listener {

	public function onEnable() {
        @mkdir($this->getDataFolder());
        $this->data = new Config($this->getDataFolder() . "Mine.yml", Config::YAML,[
        	"Block" => 48
        ]);
        $this->db = $this->data->getAll ();
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	public function onBlockBreak(BlockBreakEvent $event) {
		$player = $event->getPlayer();
		$name = $player->getName();
		$block = $event->getBlock();
		$level = $block->getLevel();
		$id = $block->getId();		
		if ($id == 48){
			$event->setCancelled();
			$block->getLevel()->setBlock(new Position($block->getX(), $block->getY(), $block->getZ(), $block->getLevel()), Block::get($this->db ["Block"]));
			$this->getItem($player);
		}
	}
	public function getItem(PLayer $player){
		$rand = mt_rand(1,100);
		if($rand <= 2){
			$player->getInventory()->addItem(Item::get(388,0,1));
			return true;
		}
		 if($rand > 2 && $rand <= 5){
			$player->getInventory()->addItem(Item::get(264,0,1));
			return true;
		}
		if($rand > 5 && $rand <= 10){
			$player->getInventory()->addItem(Item::get(265,0,1));
			return true;
		}
		if($rand > 10 && $rand <= 15){
			$player->getInventory()->addItem(Item::get(266,0,1));
			return true;
		}
		if($rand > 15 && $rand <= 20){
			$player->getInventory()->addItem(Item::get(263,0,1));
			return true;
		}
		if($rand > 20 && $rand <= 25){
			return Item::get(351, 4, mt_rand(1, 4));
			$player->getInventory()->addItem(Item::get(351,4,mt_rand(1,4)));
			return true;
		}
		if($rand > 25 && $rand <= 30){
			$player->getInventory()->addItem(Item::get(331,0,mt_rand(1,4)));
			return true;
		}
		if($rand > 30){
			$player->getInventory()->addItem(Item::get(4,0,1));
			return true;
		}
	}
}