<?php
	namespace kriskotooBG\XPMaster;
	
	use pocketmine\plugin\PluginBase;
	use pocketmine\command\Command;
	use pocketmine\command\CommandSender;
	use pocketmine\Player;
	use pocketmine\utils\TextFormat as TF;
	
	
	
	class Main extends PluginBase{
		
		public function onEnable(){
			$this->getLogger()->info("XPMaster has loaded successfully!");
		}
		
		
		public function onCommand(CommandSender $sender, Command $command, string $label, array $args):bool{
			switch(strtolower($command)){
				case "xp":
					if(isset($args[0]) && !empty($args[0])){
						if(is_numeric($args[0])){
							if(intval($args[0]) >= 0 && intval($args[0]) <= 24791){
								if($sender instanceof Player){
									if($sender->hasPermission("xp.setOwnXP")){
										$sender->setXpLevel(intval($args[0]));
										$sender->sendMessage(TF::GREEN . "Your XP level has been set to " . intval($args[0]));
									}
									else{
										$sender->sendMessage(TF::RED . "You do not have permission to use that command.");
										return true;
									}
								}
								else{
									$sender->sendMessage(TF::RED . "Please use this command in-game!");
									return true;
								}
							}
							else{
								$sender->sendMessage(TF::RED . "Invalid xp level ammount! Please provide a number between 0 and 24791!");
								return true;
							}
						}
						else if(!is_numeric($args[0]) && isset($args[1]) && !empty($args[1])){
							$target = $this->getServer()->getPlayer($args[0]);
						}
						else{
							$sender->sendMessage(TF::GOLD . "Ussage: /xp <(Optional)player> <level>");
							return true;
						}
					}
					else{
						$sender->sendMessage(TF::GOLD . "Ussage: /xp <(Optional)player> <level>");
						return true;
					}
					break;
			}
		}
	}
?>
