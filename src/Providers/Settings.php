<?php
/**
 * WPPG-Man
 */
namespace WPPGMan\Providers;

use WPPGMan\Exceptions\SettingsException;
use WPPGMan\Exceptions\ExceptionsList;

class Settings
{

    protected $file = 'settings.json';
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

        if (substr($this->path, -1) !== '/' ||
            substr($this->path, -1) !== '\\') $this->path .= '/';

    }

    /**
     * Check settings file availability.
     * 
     * @return bool
     * True if file is exist and able to rewrite, or can be create.
     * Otherwise the method will return false.
     */
    protected function settingsFileCheck() : bool
    {

        $test_content = file_exists($this->path.$this->file) ?
            file_get_contents($this->path.$this->file) : json_encode([]);

        if (file_put_contents(
            $this->path.$this->file,
            $test_content
        ) === false) return false;
        else return true;

    }

}
