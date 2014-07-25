<?php
/**
 * User: rrafia
 * Date: 7/23/14
 */

namespace Aracademia\Lightning;

use Form, Config;
use Illuminate\Support\Facades\Request;


class LightningFormBuilder {

    protected static $instance;

    public static function create($name, $open = array(), $inputFields = array(), $submitBtn = array())
    {
        $open['name'] = $name;
        $open['role'] = 'form';

        $form = static::openForm($open);
        $form .= static::fields($name, $inputFields);
        $form .= static::submit($submitBtn);

        return $form;
    }

    private static function openForm(array $open)
    {
        return  Form::open($open);
    }

    private static function fields($name, $inputFields)
    {
        $form = null;
        $type = null;

        $name = str_replace(' ', '', strtolower($name));

        $inputs = static::checkArrayKeyExist($name, Config::get("Lightning::forms"));

        $userFields = array_keys($inputFields);

        $defaultFields = explode(',', $inputs);

        $fields = array_unique(array_merge($defaultFields, $userFields));

        foreach($fields as $field)
        {
            $field = str_replace(' ','',$field);

            $attrValueToArray = static::getFieldAttr($field, $inputFields);

            $form .= static::wrapper();
            $form .= static::label($field);
            $form .= static::field($field, $attrValueToArray);
            $form .= '</'.Config::get("Lightning::htmlWrapper").'>';
        }

            return $form;

    }
    private static function wrapper()
    {
        return "<".Config::get("Lightning::htmlWrapper")." class='form-group'>";
    }
    private static function label($field)
    {
        return Form::label($field, ucwords(str_replace('_',' ',$field)));
    }
    private static function field($field, $attr)
    {
        switch($field)
        {
            case 'password': //same as $field = 'password' OR $field = 'password_confirmation'
            case 'password_confirmation':
                return Form::password($field, $attr);
                break;

        }
            if(array_key_exists('type',$attr))
            {
                return Form::$attr['type']($field, null, $attr);
            }
            $guessType = array_get(Config::get('Lightning::inputTypes'), $field) ?: 'text';
            return Form::$guessType($field, null, $attr);

    }

    private static function getFieldAttr($field, $inputFields)
    {
        $attrValueToArray = array();
        if(array_key_exists($field, $inputFields))
        {
            $fieldValue = $inputFields[$field];
            $fieldValueToArray = explode(',', $fieldValue);
            foreach($fieldValueToArray as $attribute)
            {
                list($key, $val) = explode(':',$attribute);
                $attrValueToArray[$key] = $val;
            }

        }
       if(array_key_exists('class', $attrValueToArray))
       {
           return $attrValueToArray;
       }
        $attrValueToArray['class'] = Config::get("Lightning::inputClass");
        return $attrValueToArray;
    }

    private static function submit($submitBtn)
    {
        $attr = $submitBtn;

        if(!array_key_exists('class', $attr))
        {
            $attr['class'] = Config::get('Lightning::submitClass');
        }
        if(!array_key_exists('value', $attr))
        {
            $value = Config::get('Lightning::submitName');
        }
        else
        {
            $value = $attr['value'];
        }

        return Form::submit($value, $attr);
    }

    private static function checkArrayKeyExist($key, $arr)
    {
        if(array_key_exists($key, $arr))
        {
            return array_get($arr,$key);
        }
        return array();
    }




}