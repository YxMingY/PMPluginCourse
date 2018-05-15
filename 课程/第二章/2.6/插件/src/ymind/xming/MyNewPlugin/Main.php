<?php
//命名空间
namespace ymind\xming\MyNewPlugin;
//调用PluginBase类，方便继承
use pocketmine\plugin\PluginBase;
//调用Listener接口，方便继承
use pocketmine\event\Listener;
//调用玩家进服类
use pocketmine\event\player\PlayerInteractEvent;
//调用Item类
use pocketmine\item\Item;

//主类 继承了PluginBase类，Listener接口
class Main extends PluginBase implements Listener{
   public function onLoad(){
      //插件加载时执行
      //用Logger在控制台显示普通消息(白字)
      $this->getLogger()->info("MyNewPlugin 正在加载!");
   }
   public function onEnable(){
      //插件启动时执行
      //用Logger在控制台显示公告消息(蓝字)
      $this->getLogger()->notice("MyNewPlugin 已启动! 作者:xMing");
      //为主类注册事件，有了这段代码后，主类就可以监听事件了
      $this->getServer()->getPluginManager()->registerEvents($this,$this);
   }
   public function onDisable(){
      //插件关闭时执行
      //用Logger在控制台显示警告消息(黄/红字)
      $this->getLogger()->warning("MyNewPlugin 已关闭!");
   }
   //这个类用来监听玩家点方块事件，
   public function onPlayerTouch(PlayerInteractEvent $event){
      //触发事件的玩家
      $player=$event->getPlayer();
      //西瓜的id(360)
      $melon_id=Item::MELON;
      //玩家点地用的物品
      $item=$event->getItem();
      //玩家点地物品的id
      $id=$item->getID();
      //如果玩家点地物品的id等于西瓜的id(360)
      if($id=$melon_id){
         //把玩家血量设置为上限值(即回满)
         $player->setHealth($player->getMaxHealth());
         $player->sendMessage("西瓜点地回血ing");
      }
   }
}