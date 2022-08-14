<?php

declare(strict_types=1);

namespace Container;

use DI\Container;
use DI\ContainerBuilder;
use Source\Config;

class MyContainer
{

    public static $builder;
    /**
     * buildContainer
     *
     * Returns a new Container Object
     *
     * @return Container
     */
    public static function MyContainer(): Container
    {
        self::$builder = new ContainerBuilder();
        self::$builder->useAutowiring(true);
        self::$builder->addDefinitions(Config::DATA_LAYER_CONFIG);
        return self::$builder->build();
    }
}
