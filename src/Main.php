<?php
/**
 * WPPG-Man 0.1.1 by Chirontex (chirontex@yandex.com)
 * License: GNU GPL v3
 */
namespace WPPGMan;

use WPPGMan\Exceptions\MainException;

final class Main
{

    public function __construct(array $incoming)
    {

        if (empty($incoming)) throw new MainException(
            'Incorrect object creation. ('.__CLASS__.')',
            -1
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
