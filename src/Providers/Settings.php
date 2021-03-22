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
    protected $settings = [];
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
     * Set the setting.
     * 
     * @param string $key
     * if setting already exist, it will be rewrite.
     * 
     * @param string $value
     * Value cannot be resourse.
     * 
     * @return $this
     * 
     * @throws WPPGMan\Exceptions\SettingsException
     */
    public function settingSet(string $key, string $value) : self
    {

        if ($this->settings === []) $this->settingsInternalLoad();
        
        $this->settings[$key] = $value;

        return $this;

    }

    /**
     * Get the value of the setting.
     * 
     * @param string $key
     * 
     * @return mixed
     * If setting is not exist, the method will return an empty string.
     */
    public function settingGet(string $key) : string
    {

        if (empty($this->settings)) $this->settingsInternalLoad();

        if (isset($this->settings[$key])) return $this->settings[$key];
        else return '';

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

        if (empty($this->settings)) $this->settingsInternalLoad();

        return $this->settings;

    }

    /**
     * Save settings to file.
     * 
     * @param bool $exception_null_settings
     * If true, the method will throw an exception if $this->settings === null.
     * 
     * @return $this
     * 
     * @throws WPPGMan\Exceptions\SettingsException
     */
    public function settingsSave(bool $exception_null_settings = true) : self
    {

        if (empty($this->settings)) {

            if ($exception_null_settings) throw new SettingsException(
                ExceptionsList::SETTINGS['-12']['message'],
                ExceptionsList::SETTINGS['-12']['code']
            );

        } else {

            if ($this->settingsFileCheck()) file_put_contents(
                $this->path.$this->file,
                json_encode($this->settings, JSON_UNESCAPED_UNICODE)
            );
            else throw new SettingsException(
                ExceptionsList::SETTINGS['-11']['message'],
                ExceptionsList::SETTINGS['-11']['code']
            );

        }

        return $this;

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

        if (empty($this->settings)) {

            if ($this->settingsFileCheck()) $this->settings = json_decode(
                file_get_contents($this->path.$this->file),
                true
            );
            else throw new SettingsException(
                ExceptionsList::SETTINGS['-11']['message'],
                ExceptionsList::SETTINGS['-11']['code']
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
