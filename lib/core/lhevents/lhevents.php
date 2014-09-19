<?php

class erLhcoreClassEvents {
         
   public static function getSession($type = false)
   {                
        if ($type === false && !isset( self::$persistentSession ) )
        {
            self::$persistentSession = new ezcPersistentSession(
                ezcDbInstance::get(),
                new ezcPersistentCodeManager( './pos/lhevents' )
            );
        } elseif ($type !== false && !isset( self::$persistentSessionSlave ) ) {            
            self::$persistentSessionSlave = new ezcPersistentSession(
                ezcDbInstance::get($type),
                new ezcPersistentCodeManager( './pos/lhevents' )
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