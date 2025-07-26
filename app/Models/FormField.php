<?php

namespace App\Models;

use Illuminate\Support\Collection;

class FormField
{
    const TYPE_TEXT = 'text';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_SELECT = 'select';
    const TYPE_RADIO = 'radio';
    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_EMAIL = 'email';
    const TYPE_NUMBER = 'number';
    const TYPE_DATE = 'date';
    const TYPE_FILE = 'file';
    const TYPE_HEADING = 'heading';
    const TYPE_PARAGRAPH = 'paragraph';

    public static function getAvailableTypes(): array
    {
        return [
            self::TYPE_TEXT => 'Text Input',
            self::TYPE_TEXTAREA => 'Textarea',
            self::TYPE_SELECT => 'Select Dropdown',
            self::TYPE_RADIO => 'Radio Buttons',
            self::TYPE_CHECKBOX => 'Checkboxes',
            self::TYPE_EMAIL => 'Email',
            self::TYPE_NUMBER => 'Number',
            self::TYPE_DATE => 'Date',
            self::TYPE_FILE => 'File Upload',
            self::TYPE_HEADING => 'Heading',
            self::TYPE_PARAGRAPH => 'Paragraph Text',
        ];
    }

    public static function getFieldTypesWithOptions(): array
    {
        return [
            self::TYPE_SELECT,
            self::TYPE_RADIO,
            self::TYPE_CHECKBOX,
        ];
    }

    public static function getFieldTypesWithoutInput(): array
    {
        return [
            self::TYPE_HEADING,
            self::TYPE_PARAGRAPH,
        ];
    }

    public static function validateFieldData(array $field): array
    {
        $errors = [];

        if (empty($field['type'])) {
            $errors[] = 'Field type is required';
        } elseif (!array_key_exists($field['type'], self::getAvailableTypes())) {
            $errors[] = 'Invalid field type';
        }

        if (empty($field['label']) && !in_array($field['type'], self::getFieldTypesWithoutInput())) {
            $errors[] = 'Field label is required';
        }

        if (in_array($field['type'], self::getFieldTypesWithOptions()) && empty($field['options'])) {
            $errors[] = 'Field options are required for this field type';
        }

        return $errors;
    }
}
