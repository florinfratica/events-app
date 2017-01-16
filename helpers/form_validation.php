<?php

function form_is_valid($errors)
{
    foreach ($errors as $error) {
        if ($error) {
            return false;
        }
    }
    return true;
}

function field_is_empty($field)
{
    if (!$field) {
        return 'Câmpul este obligatoriu';
    }
}

function field_isnt_email($field)
{
    if (!filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return 'Câmpul nu conține o adresă de email validă';
    }
}

function fields_dont_match($field, $matching_field)
{
    if ($field != $matching_field) {
        return 'Câmpul de confirmare nu este identic';
    }
}

function field_choises($field, $choises)
{
    if (count($field) != $choises) {
        return "Trebuie să selectezi $choises opțiuni";
    }
}

function field_date_has_passed($field)
{
    if (!$field) {
        return;
    }
    $date = DateTime::createFromFormat("Y-m-d\TH:i", $field);
    $timestamp = strtotime($date->format('Y-m-d H:i:s'));
    if ($timestamp < time()) {
        return 'Trebuie să alegi o dată din viitor';
    }
}

function no_file_selected($file)
{
    if (!file_exists($file)) {
        return 'Nu ai selectat niciun fișier';
    }
}

function file_not_image($file)
{
    if (!file_exists($file)) {
        return;
    }
    $imagesizedata = getimagesize($file);
    if ($imagesizedata == false) {
        return 'Fișierul nu este o imagine';
    }
}

function image_size($file, $width, $height)
{
    if (!file_exists($file)) {
        return;
    }
    $imagesizedata = getimagesize($file);
    if ($imagesizedata[0] != $width || $imagesizedata[1] != $height) {
        return 'Imaginea nu are dimensiunile cerute';
    }
}

function field_in_database()
{
    return 'Deja în baza de date';
}
