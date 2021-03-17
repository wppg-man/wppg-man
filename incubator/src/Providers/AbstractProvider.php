<?php
/**
 * plugin-name
 */
namespace PluginMainNamespace\Providers;

use PluginMainNamespace\Exceptions\AbstractProviderException;
use wpdb;

abstract class AbstractProvider
{

    protected $wpdb;
    protected $table;
    protected $columns;
    protected $indexes;

    public function __construct(wpdb $wpdb)
    {
        
        $this->wpdb = $wpdb;

        $this->tableCreate();

    }

    /**
     * Create the table.
     * 
     * @return $this
     * 
     * @throws PluginMainNamespace\Exceptions\AbstractProviderException
     */
    public function tableCreate() : self
    {

        $fn = function(array $arr, string $format) {

            $result = "";

            foreach ($arr as $name => $params) {

                $result = ", ".sprintf($format, $name, $params);

            }

            return $result;

        };

        if (is_array($this->columns)) $columns = call_user_func(
                $fn,
                $this->columns,
                "`%1\$s` %2\$s"
            );
        else $columns = "";

        if (is_array($this->indexes)) $indexes = call_user_func(
                $fn,
                $this->indexes,
                "%2\$s `%1\$s` (`%1\$s`)"
            );
        else $indexes = "";

        if ($this->wpdb->query(
            "CREATE TABLE IF NOT EXISTS `".$this->wpdb->prefix.$this->table."` (
                `id` BIGINT NOT NULL AUTO_INCREMENT".$columns.",
                PRIMARY KEY (`id`)".$indexes."
            )
            COLLATE='utf8mb4_unicode_ci'
            AUTO_INCREMENT=0"
        ) === false) throw new AbstractProviderException(
            AbstractProviderException::CREATE_TABLE_FAILURE_MESSAGE.
                ' ('.$this->table.')',
            AbstractProviderException::CREATE_TABLE_FAILURE_CODE
        );

        return $this;

    }

}
