<?php

namespace Brisum\Wordpress\SeoData\Model;

/**
* @property int id
* @property string url
* @property string title
* @property string meta_description
* @property string meta_keywords
* @property string h1
* @property string content
 */
class SeoData
{
    const TABLE = 'brisum_seo_data';

    protected $data = [
        'id' => '',
        'url' => '',
        'title' => '',
        'meta_description' => '',
        'meta_keywords' => '',
        'h1' => '',
        'content' => ''
    ];

    public function __set($name, $value)
    {
        if (!isset($this->data[$name])) {
            throw new \Exception("Undefined field {$name}.", E_ERROR);
        }

        if (method_exists($this, $name)) {
            $this->$name($value);
        } else {
            $this->data[$name] = $value;
        }
    }

    public function __get($name)
    {
        if (!isset($this->data[$name])) {
            throw new \Exception("Undefined field {$name}.", E_ERROR);
        }
        if (method_exists($this, $name)) {
            return $this->$name();
        }
        return $this->data[$name];
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public function add()
    {
        global $wpdb;
        $affected = $wpdb->insert($wpdb->prefix . self::TABLE, $this->data);

        if ($affected) {
            $this->data = self::getData($wpdb->insert_id);
        }

        return $affected;
    }

    public function save()
    {
        global $wpdb;
        $affected = $wpdb->update($wpdb->prefix . self::TABLE, $this->data, ['id' => $this->id]);

        if ($affected) {
            $this->data = self::getData($this->id);
        }

        return $affected;
    }

    public function delete()
    {
        global $wpdb;
        return $wpdb->delete($wpdb->prefix . self::TABLE, ['id' => $this->id]);
    }

    /**
     * @param int $id
     * @return SeoData|null;
     */
    public static function get($id)
    {
        $result = self::getData($id);

        if (!$result) {
            return null;
        }
        $model = new self();
        $model->data = $result;
        return $model;
    }

    /**
     * @param int $id
     * @return SeoData|null;
     */
    public static function getData($id)
    {
        global $wpdb;
        return $wpdb->get_row(
            $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . self::TABLE . " WHERE id='%d'", intval($id)),
            ARRAY_A
        );
    }

    /**
     * @param string $url
     * @return SeoData|null;
     */
    public static function findByUrl($url)
    {
        global $wpdb;
        $result = $wpdb->get_row(
            $wpdb->prepare("SELECT * FROM " . $wpdb->prefix . self::TABLE . " WHERE url='%s'", $url),
            ARRAY_A
        );

        if (!$result) {
            return null;
        }
        $model = new self();
        $model->data = $result;
        return $model;
    }

    /**
     * @return SeoData[]
     */
    public static function getAll()
    {
        global $wpdb;
        $results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . self::TABLE . " ORDER BY url", ARRAY_A);

        foreach ((array)$results as $key => $result) {
            $model = new self();
            $model->data = $result;
            $results[$key] = $model;
        }

        return $results;
    }
}
