<?php
namespace himbeer\vipcmds;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\permission\Permission;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerGameModeChangeEvent;
class main extends PluginBase implements Listener{
     
     public function onEnable(){
          $this->getServer()->getPluginManager()->registerEvents($this,$this);
          $this->getLogger()->info("VIPcmds enabled!");
          $this->saveDefaultConfig();
     }
     
     public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
          switch($command->getName()){
               case "vip":
                    if(!($sender instanceof player)){
                         $sender->sendMessage("Use this command in-game!");
                    }else{
                         if(!isset($args[0])){
                              if($sender->hasPermission("vipcmds.vip")){
                                   $vip = $this->getConfig()->get("vip");
                                   $sender->sendMessage($vip);
                              }else{
                                   $novip = $this->getConfig()->get("novip");
                                   $sender->sendMessage($novip);
                              }
                         }else{
                              switch ($args[0]){
                                   case "gmc":
                                        if($sender->hasPermission("vipcmds.gm")){
                                             if($sender->getGamemode() == 1){
                                                  $already_in_gamemode = $this->getConfig()->get("already_in_gamemode");
                                                  $sender->sendMessage($already_in_gamemode);
                                             }else{
                                                  $sender->setGamemode(1);
                                                  $gmc = $this->getConfig()->get("gmc");
                                                  $sender->sendMessage($gmc);
                                             }
                                        }else{
                                             $noperm = $this->getConfig()->get("noperm");
                                             $sender->sendMessage($noperm);
                                        }
                                             break;
                                   case "gms":
                                        if($sender->hasPermission("vipcmds.gm")){
                                             if($sender->getGamemode() == 0){
                                                  $already_in_gamemode = $this->getConfig()->get("already_in_gamemode");
                                                  $sender->sendMessage($already_in_gamemode);
                                             }else{
                                                  $sender->setGamemode(0);
                                                  $gms = $this->getConfig()->get("gms");
                                                  $sender->sendMessage($gms);
                                             }
                                        }else{
                                             $noperm = $this->getConfig()->get("noperm");
                                             $sender->sendMessage($noperm);
                                        }
                                             break;
                                   case "fly":
                                        if($sender->hasPermission("vipcmds.fly")){
                                             if($sender->getAllowFlight()){
                                                  $flyoff = $this->getConfig()->get("flyoff");
                                                  $sender->sendMessage($flyoff);
                                                  $sender->setAllowFlight(false);
                                             }else{
                                                  $flyon = $this->getConfig()->get("flyon");
                                                  $sender->sendMessage($flyon);
                                                  $sender->setAllowFlight(true);
                                             }
                                        }else{
                                             $noperm = $this->getConfig()->get("noperm");
                                             $sender->sendMessage($noperm);
                                       }
                                             break;
                              }
                         }
                    }
          }
          return true;
     }
}
