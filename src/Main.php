<?php
/**
 * WPPG-Man 0.1.7
 * License: GNU GPL v3
 */
namespace WPPGMan;

use WPPGMan\Providers\Settings;
use WPPGMan\Exceptions\SettingsException;
use WPPGMan\Exceptions\MainException;
use WPPGMan\Exceptions\ExceptionsList;

final class Main
{

    public function __construct(array $incoming)
    {

        if (empty($incoming)) throw new MainException(
            ExceptionsList::COMMON['-1']['message'].' ('.__CLASS__.')',
            ExceptionsList::COMMON['-1']['code']
        );

        $command = empty($incoming[1]) ?
            'help' : (string)$incoming[1];

        switch ($command) {

            case 'set:foldername':
            case 'set:pulgin-name':
            case 'set:plugin-uri':
            case 'set:plugin-desc':
            case 'set:plugin-author':
            case 'set:plugin-author-uri':
            case 'set:PluginMainNamespace':
                $this->settingsHandle(
                    $command,
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

    private function settingsHandle(string $command, string $value) : self
    {

        return $this;

    }

    private function help() : self
    {

        return $this;

    }

}
