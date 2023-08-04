<?php

namespace App\Create\Singleton;

class Singleton
{
    private static ?Singleton $singleton = null;

    private function __construct()
    {
        // TODO: Implement __clone() method.
    }

    protected function __clone(): void
    {
        // TODO: Implement __clone() method.
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): Singleton
    {
        if (self::$singleton == null) {
            self::$singleton = new static();
        }
        return self::$singleton;
    }
}

function clientCode()
{
    $s1 = Singleton::getInstance();
    $s2 = Singleton::getInstance();
    if ($s1 === $s2) {
        echo "Singleton works, both variables contain the same instance.";
    } else {
        echo "Singleton failed, variables contain different instances.";
    }
}

clientCode();