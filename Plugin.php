<?php namespace Albrightlabs\Backendsettings;

use Event;
use Backend;
use Albrightlabs\Backendsettings\Models\Settings;
use System\Classes\PluginBase;

/**
 * backendsettings Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Backend Settings',
            'description' => 'Provides a few extra backend settings.',
            'author'      => 'Albright Labs',
            'icon'        => 'icon-gear'
        ];
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        Event::listen('backend.menu.extendItems', function($navigationManager) {
            if(Settings::instance()->hide_cms == true)
                $navigationManager->removeMainMenuItem('October.Cms', 'cms');
            if(Settings::instance()->hide_media == true)
                $navigationManager->removeMainMenuItem('October.Backend', 'media');
        });
    }

    /**
     * Register settings
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Backend Settings',
                'description' => 'Toggle display of the CMS and Media navigation items.',
                'category'    => 'system::lang.system.categories.system',
                'icon'        => 'icon-cog',
                'class'       => 'Albrightlabs\Backendsettings\Models\Settings',
                'order'       => 500,
                'keywords'    => 'admin backend settings',
                'permissions' => ['albrightlabs.backendsettings.access_settings']
            ]
        ];
    }
}
