<?php
/**
 * WPPG-Man 0.2.0
 * License: GNU GPL v3
 */
namespace WPPGMan;

use WPPGMan\Providers\Settings;
use WPPGMan\Exceptions\SettingsException;
use WPPGMan\Exceptions\MainException;
use WPPGMan\Exceptions\ExceptionsList;

final class Main
{

    private $path;

    public function __construct(string $path, array $incoming)
    {

        if (empty($incoming)) throw new MainException(
            ExceptionsList::COMMON['-1']['message'].' ('.__CLASS__.')',
            ExceptionsList::COMMON['-1']['code']
        );

        $this->path = $path;

        $command = empty($incoming[1]) ?
            'help' : (string)$incoming[1];

        switch ($command) {

            case 'set:plugins-directory':
            case 'set:foldername':
            case 'set:pulgin-name':
            case 'set:plugin-uri':
            case 'set:plugin-desc':
            case 'set:plugin-author':
            case 'set:plugin-author-uri':
            case 'set:PluginMainNamespace':
                $this->settingsHandle(
                    substr($command, 4),
                    empty($incoming[2]) ? 'help' : (string)$incoming[2]
                );
                break;

            case 'help':
                $this->help();
                break;

            default:
                echo PHP_EOL.
                    'Invalid command.'.
                    PHP_EOL;
                break;

        }

    }

    private function settingsHandle(string $key, string $value) : self
    {

        if ($value === 'help') {



        } else {

            $settings_provider = new Settings($this->path.'/config');

            $settings_provider
                ->settingSet($key, $value)
                ->settingsSave();

            echo PHP_EOL.
                'Setting "'.$key.'" is set to "'.$value.'".'.
                PHP_EOL;

        }

        return $this;

    }

    private function help() : self
    {

        return $this;

    }

}
