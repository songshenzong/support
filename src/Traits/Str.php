<?php

namespace Songshenzong\Support\Traits;

use SimpleXMLElement;
use stdClass;

trait Str
{


    /**
     * @param string $string
     *
     * @return array
     */
    public static function toArray(string $string = ''): array
    {
        if ($string === '') {
            return [];
        }

        if (self::isJson($string)) {
            return json_decode($string, true);
        }

        if (self::isXml($string)) {
            return self::xmlToArray($string);
        }

        $unserialize = self::unserialize($string);
        if ($unserialize === false) {
            return [];
        }

        if (\is_array($unserialize)) {
            return $unserialize;
        }

        return [];

    }

    /**
     * @return stdClass|SimpleXMLElement
     *
     * @param string $string
     *
     */
    public static function toObject(string $string = ''): object
    {

        if ($string === '') {
            return new stdClass();
        }


        if (self::isJson($string)) {
            return json_decode($string);
        }


        if (self::isXml($string)) {
            return self::xmlToObject($string);
        }

        $unserialize = self::unserialize($string);
        if ($unserialize === false) {
            return new stdClass();
        }

        if (\is_object($unserialize)) {
            return $unserialize;
        }

        return new stdClass();
    }


    /**
     * @param string $serialized
     *
     * @return mixed
     */
    public static function unserialize(string $serialized)
    {
        // Set Handle
        set_error_handler(function () {
        }, E_ALL);
        $result = unserialize((string) $serialized);
        // Restores the previous error handler function
        restore_error_handler();
        if ($result === false) {
            return false;
        }
        return $result;
    }

    /**
     * @param string $string
     *
     * @return bool
     */
    public static function isSerialized(string $string): bool
    {
        // Set Handle
        set_error_handler(function () {
        }, E_ALL);
        $result = unserialize($string);
        // Restores the previous error handler function
        restore_error_handler();
        return !($result === false);
    }


    /**
     * @param string $string
     *
     * @return string
     */
    public static function filter(string $string): string
    {
        $filter = [
            "\n",
            '`',
            '·',
            '~',
            '!',
            '！',
            '@',
            '#',
            '$',
            '￥',
            '%',
            '^',
            '……',
            '&',
            '*',
            '(',
            ')',
            '（',
            '）',
            '-',
            '_',
            '——',
            '+',
            '=',
            '|',
            '\\',
            '[',
            ']',
            '【',
            '】',
            '{',
            '}',
            ';',
            '；',
            ':',
            '：',
            '\'',
            '"',
            '“',
            '”',
            ',',
            '，',
            '<',
            '>',
            '《',
            '》',
            '.',
            '。',
            '/',
            '、',
            '?',
            '？',
            ';',
            'nbsp',
        ];

        $str = str_replace($filter, '', $string);
        return trim($str);
    }


    /**
     * @param string $string
     *
     * @return string
     */
    public static function trim(string $string): string
    {
        $filter = [
            "\0",
            "\n",
            "\t",
            "\x0B",
            "\r",
            ' ',
        ];

        $str = str_replace($filter, '', $string);
        return trim($str);
    }


    /**
     * Is Set and Not Empty.
     *
     * @param $value
     *
     * @return bool
     */
    public static function isSetAndNotEmpty($value): bool
    {
        return isset($value) && !empty($value);
    }

    /**
     * Is Set and Not Empty and Not Null.
     *
     * @param $value
     *
     * @return bool
     */
    public static function isSetAndNotEmptyAndNotNull($value): bool
    {
        return isset($value) && !empty($value) && $value !== 'null';
    }


    /**
     * @param string $string
     *
     * @return bool
     */
    public static function isJson(string $string = ''): bool
    {
        if ($string === '') {
            return false;
        }

        \json_decode($string);
        if (\json_last_error()) {
            return false;
        }

        return true;
    }

    /**
     * @param string $string
     *
     * @return bool
     */
    public static function isXml(string $string = ''): bool
    {
        if ($string === '') {
            return false;
        }

        $xml_parser = xml_parser_create();
        if (!xml_parse($xml_parser, $string, true)) {
            xml_parser_free($xml_parser);
            return false;
        }

        return true;
    }


    /**
     * @param string $string
     *
     * @return array
     */
    public static function xmlToArray(string $string): array
    {
        return json_decode(json_encode(simplexml_load_string($string)), true);
    }


    /**
     * @param string $string
     *
     * @return SimpleXMLElement
     */
    public static function xmlToObject(string $string): SimpleXMLElement
    {
        return simplexml_load_string($string);
    }

}
