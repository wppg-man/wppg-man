<?php
/**
 * WPPG-Man
 */
namespace WPPGMan\Providers;

use WPPGMan\Exceptions\SettingsException;
use WPPGMan\Exceptions\ExceptionsList;

class Settings
{

    protected $path;

    public function __construct(string $path)
    {
        
        if (empty($path)) $this->path = __DIR__;
        else {

            if (file_exists($path)) {

                if (is_dir($path)) $this->path = $path;
                else throw new SettingsException(
                    ExceptionsList::COMMON['-2']['message'].' ('.$path.')',
                    ExceptionsList::COMMON['-2']['code']
                );

            } else {

                if (mkdir($path)) $this->path = $path;
                else throw new SettingsException(
                    ExceptionsList::COMMON['-3']['message'].' ('.$path.')',
                    ExceptionsList::COMMON['-3']['code']
                );

            }

        }

    }



}
