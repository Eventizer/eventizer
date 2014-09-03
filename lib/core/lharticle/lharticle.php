<?php

class erLhcoreClassArticle {
         
   public static function getSession($type = false)
   {                
        if ($type === false && !isset( self::$persistentSession ) )
        {
            self::$persistentSession = new ezcPersistentSession(
                ezcDbInstance::get(),
                new ezcPersistentCodeManager( './pos/lharticle' )
            );
        } elseif ($type !== false && !isset( self::$persistentSessionSlave ) ) {            
            self::$persistentSessionSlave = new ezcPersistentSession(
                ezcDbInstance::get($type),
                new ezcPersistentCodeManager( './pos/lharticle' )
            );
        }
        
        return $type === false ? self::$persistentSession : self::$persistentSessionSlave;
        
   }   
   
   // For all others
   private static $persistentSession;
   
   // For selects
   private static $persistentSessionSlave;
}

?>