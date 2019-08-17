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
							if(intval($args[0]) >= 0 && intval($args[0]) <= 24790){
								if($sender instanceof Player){
									if($sender->hasPermission("xp.setOwnXP")){
										$sender->setXpLevel(intval($args[0]));
										$sender->sendMessage(TF::GREEN . "Your XP level has been set to " . intval($args[0]));
										return true;
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
								$sender->sendMessage(TF::RED . "Invalid xp level ammount! Please provide a number between 0 and 24790!");
								return true;
							}
						}
						else if(!is_numeric($args[0]) && isset($args[1]) && !empty($args[1]) && is_numeric($args[1])){
							$target = $this->getServer()->getPlayer($args[0]);
							
							if($target instanceof Player){
								if(intval($args[1]) >= 0 && intval($args[1]) <= 24790){
									if($sender->hasPermission("xp.setPlayerXP")){
										$target->setXpLevel(intval($args[1]));
										$target->sendMessage(TF::GREEN . "Your XP level has been set to " . intval($args[1]) . " by " . $sender->getName());
										$sender->sendMessage(TF::GREEN . "Set " . $target->getName() . "'s XP level to " . intval($args[1]));
										return true;
									}
									else{
										$sender->sendMessage(TF::RED . "You do not have permission to use that command.");
										return true;
									}
								}
								else{
									$sender->sendMessage(TF::RED . "Invalid xp level ammount! Please provide a number between 0 and 24790!");
									return true;
								}
							}
							else{
								$sender->sendMessage(TF::RED . "Did not find an online player with a name of " . $args[0]);
								return true;
							}
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
				
				case "seexp":
					if(isset($args[0]) && !empty($args[0])){
						if($sender->hasPermission("xp.seePlayerXP")){
							$target = $this->getServer()->getPlayer($args[0]);
							
							if($target instanceof Player){
								$sender->sendMessage(TF::GREEN . $args[0] . "'s XP level is: " . $target->getXpLevel());
								return true;
							}
							else{
								$sender->sendMessage(TF::RED . "Did not find an online player with a name of " . $args[0]);
								return true;
							}
						}
						else{
							$sender->sendMessage(TF::RED . "You do not have permission to use that command.");
							return true;
						}
					}
					else{
						$sender->sendMessage(TF::GOLD . "Ussage: /seexp <player>");
						return true;
					}
					break;
				
				case "addxp":
					if(isset($args[0]) && !empty($args[0])){
						if(is_numeric($args[0])){
							if(intval($args[0]) >= 0 && intval($args[0]) <= 24790){
								if($sender instanceof Player){
									if($sender->hasPermission("xp.addOwnXP")){
										if($sender->getXpLevel() + intval($args[0]) < 24790){
											$sender->setXpLevel(($sender->getXpLevel() + intval($args[0])));
											$sender->sendMessage(TF::GREEN . intval($args[0]) . " Levels have been added to your XP level");
											return true;
										}
										else{
											$sender->sendMessage(TF::RED . "The resulting XP level is bigger than the maximum possible (24790)!");
											return true;
										}
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
								$sender->sendMessage(TF::RED . "Invalid xp level ammount! Please provide a number between 0 and 24790!");
								return true;
							}
						}
						else if(!is_numeric($args[0]) && isset($args[1]) && !empty($args[1]) && is_numeric($args[1])){
							$target = $this->getServer()->getPlayer($args[0]);
							
							if($target instanceof Player){
								if(intval($args[1]) >= 0 && intval($args[1]) <= 24791){
									if($sender->hasPermission("xp.addPlayerXP")){
										if($target->getXpLevel() + intval($args[1]) < 24790){
											$target->setXpLevel(($sender->getXpLevel() + intval($args[1])));
											$target->sendMessage(TF::GREEN . intval($args[1]) . " xp levels have been added to your xp by " . $sender->getName());
											$sender->sendMessage(TF::GREEN . "Added " . intval($args[1]) . " to " . $target->getName() . "'s XP level");
											return true;
										}
										else{
											$sender->sendMessage(TF::RED . "The resulting XP level is bigger than the maximum possible (24790)!");
											return true;
										}
									}
									else{
										$sender->sendMessage(TF::RED . "You do not have permission to use that command.");
										return true;
									}
								}
								else{
									$sender->sendMessage(TF::RED . "Invalid xp level ammount! Please provide a number between 0 and 24791!");
									return true;
								}
							}
							else{
								$sender->sendMessage(TF::RED . "Did not find an online player with a name of " . $args[0]);
								return true;
							}
						}
						else{
							$sender->sendMessage(TF::GOLD . "Ussage: /addxp <(Optional)player> <level>");
							return true;
						}
					}
					else{
						$sender->sendMessage(TF::GOLD . "Ussage: /addxp <(Optional)player> <level>");
						return true;
					}
					break;
				
				case "remxp":
					if(isset($args[0]) && !empty($args[0])){
						if(is_numeric($args[0])){
							if(intval($args[0]) >= 0 && intval($args[0]) <= 24790){
								if($sender instanceof Player){
									if($sender->hasPermission("xp.remOwnXP")){
										if($sender->getXpLevel() - intval($args[0]) >= 0){
											$sender->setXpLevel(($sender->getXpLevel() - intval($args[0])));
											$sender->sendMessage(TF::GREEN . intval($args[0]) . " Levels have been removed from your XP level");
											return true;
										}
										else{
											$sender->sendMessage(TF::RED . "The resulting XP level cannot be lower than 0!");
											return true;
										}
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
								$sender->sendMessage(TF::RED . "Invalid xp level ammount! Please provide a number between 0 and 24790!");
								return true;
							}
						}
						else if(!is_numeric($args[0]) && isset($args[1]) && !empty($args[1]) && is_numeric($args[1])){
							$target = $this->getServer()->getPlayer($args[0]);
							
							if($target instanceof Player){
								if(intval($args[1]) >= 0 && intval($args[1]) <= 24791){
									if($sender->hasPermission("xp.remPlayerXP")){
										if($target->getXpLevel() - intval($args[1]) >= 0){
											$target->setXpLevel(($sender->getXpLevel() - intval($args[1])));
											$target->sendMessage(TF::GREEN . intval($args[1]) . " xp levels have been removed from your xp by " . $sender->getName());
											$sender->sendMessage(TF::GREEN . "Removed " . intval($args[1]) . " from " . $target->getName() . "'s XP level");
											return true;
										}
										else{
											$sender->sendMessage(TF::RED . "The resulting XP level cannot be lower than 0!");
											return true;
										}
									}
									else{
										$sender->sendMessage(TF::RED . "You do not have permission to use that command.");
										return true;
									}
								}
								else{
									$sender->sendMessage(TF::RED . "Invalid xp level ammount! Please provide a number between 0 and 24791!");
									return true;
								}
							}
							else{
								$sender->sendMessage(TF::RED . "Did not find an online player with a name of " . $args[0]);
								return true;
							}
						}
						else{
							$sender->sendMessage(TF::GOLD . "Ussage: /remxp <(Optional)player> <level>");
							return true;
						}
					}
					else{
						$sender->sendMessage(TF::GOLD . "Ussage: /remxp <(Optional)player> <level>");
						return true;
					}
					break;
			}
		}
	}
?>
