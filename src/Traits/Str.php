<?php

namespace Songshenzong\Support\Traits;

trait Str
{
    /**
     * @param $str
     *
     * @return string
     */
    public function stringFilter($str): string
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

        $str = str_replace($filter, '', $str);
        return trim($str);
    }


    /**
     * @param $str
     *
     * @return string
     */
    public function stringTrim($str): string
    {
        $filter = [
            "\0",
            "\n",
            "\t",
            "\x0B",
            "\r",
            ' ',
        ];

        $str = str_replace($filter, '', $str);
        return trim($str);
    }


    /**
     * Is Set and Not Empty.
     *
     * @param $value
     *
     * @return bool
     */
    public function isSetAndNotEmpty($value): bool
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
    public function isSetAndNotEmptyAndNotNull($value): bool
    {
        return isset($value) && !empty($value) && $value !== 'null';
    }
}
