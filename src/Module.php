<?php

declare(strict_types=1);

namespace Webinertia\Utils;

use Webinertia\Utils\ConfigProvider;

class Module
{
    /**
     * Return webinertia-modulemanager configuration for laminas-mvc application.
     *
     * @return array
     */
    public function getConfig()
    {
        $provider = new ConfigProvider();
        return [
            'service_manager' => $provider->getDependencyConfig(),
        ];
    }
}
