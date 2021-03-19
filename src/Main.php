<?php
/**
 * WPPG-Man 0.1.2
 * License: GNU GPL v3
 */
namespace WPPGMan;

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
            'help' : $incoming[1];

        switch ($command) {

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

    public function help() : self
    {

        return $this;

    }

}
