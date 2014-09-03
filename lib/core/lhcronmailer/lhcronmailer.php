<?php

class erLhcoreClassCronMailer {

   public static function getSession()
   {
        if ( !isset( self::$persistentSession ) )
        {
            self::$persistentSession = new ezcPersistentSession(
                ezcDbInstance::get(),
                new ezcPersistentCodeManager( './pos/lhcronmailer' )
            );
        }
        return self::$persistentSession;
   }

   private static $persistentSession;
}

?>