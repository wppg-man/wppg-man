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
    protected $settings = NULL;
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
     * Load and output settings.
     * 
     * @return array
     * 
     * @throws WPPGMan\Exceptions\SettingsException
     */
    public function settingsLoad() : array
    {

        if ($this->settings === NULL) $this->settingsInternalLoad();

        return $this->settings;

    }

    /**
     * Load settings and store in into the $settings property.
     * 
     * @return $this
     * 
     * @throws WPPGMan\Exceptions\SettingsException
     */
    protected function settingsInternalLoad() : self
    {

        if ($this->settings === NULL) {

            if ($this->settingsFileCheck()) $this->settings = json_decode(
                file_get_contents($this->path.$this->file),
                true
            );
            else throw new SettingsException(
                ExceptionsList::SETTINGS['-11']['message'],
                ExceptionsList::SETTINGS['-11']['code']
            );

            if ($this->settings === NULL) throw new SettingsException(
                ExceptionsList::COMMON['-4']['message'].
                    ' ('.$this->path.$this->file.')',
                ExceptionsList::COMMON['-4']['code']
            );

        }

        return $this;

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

        $result = file_put_contents($this->path.$this->file, $test_content);
        $result = $result === false ? false : true;

        return $result;

    }

}
