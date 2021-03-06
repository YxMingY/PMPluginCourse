<?php
//命名空间
namespace ymind\xming\MyNewPlugin;
//调用PluginBase类，方便继承
use pocketmine\plugin\PluginBase;
//调用Listener接口，方便继承
use pocketmine\event\Listener;
//调用玩家进服事件类
use pocketmine\event\player\PlayerJoinEvent;
//玩家移动事件
use pocketmine\event\player\PlayerMoveEvent;
//实体伤害事件
use pocketmine\event\entity\EntityDamageEvent;
//玩家类，方便判断实体是不是玩家
use pocketmine\Player;
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
   //这个类用来监听玩家进服事件，
   //特别注意前面use了事件
   //类名随意，参数中规定事件类
   public function onPlayerJoin(PlayerJoinEvent $event){
      //用事件的getPlayer()方法获取玩家
      $player=$event->getPlayer();
      //用玩家的getName()方法获取玩家名字
      $name=$player->getName();
      
      
      /* 还记得么
      调用Player的sendMeesage()方法对玩家发送消息
      调用Server的broadcastMessage()方法对全服发送公告
      
      调用player的isOp()方法判断玩家是不是op    返回值是bool
      */
      
      if($player->isOp()){
         $player->sendMessage("哇，是OP大大".$name."啊，欢迎欢迎。");
         $this->getServer()->broadcastMessage("天空一声巨响，管理员".$name."闪亮登场!");
      }else{
         $player->sendMessage($name."小朋友，欢迎。");
         $this->getServer()->broadcastMessage("玩家".$name."加入了服务器。");
      }
   }
   
   //监听玩家移动事件
   public function onPlayerMove(PlayerMoveEvent $event){
      $player=$event->getPlayer();
      if($player->getName()=="Steve"){
         //取消事件
         $event->setCancelled();
         //Player的sendPopup()方法给玩家发送底部显示
         $player->sendPopup("Steve不许动!");
         //好啦，你可以用Steve进服试试。
      }
   }
   
   //实体伤害事件，有实体受到伤害时触发。
   public function onEntityDamage(EntityDamageEvent $event){
      /*
      $event->getEntity()获取受伤实体
      $event->getDamager()获取伤害造成者
      $event->getDamage()获取伤害值
      $event->setDamage(int $damage)设置伤害值
      */
      $entity=$event->getEntity();
      if($entity instanceof Player){
         //如果是收到伤害的是玩家类,设置伤害为0
         $event->setDamage(0);
      }
   }
}