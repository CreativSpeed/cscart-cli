<?php

namespace App\Utils;

class Helpers
{

    protected $lang_obj = [
        'ar' => ['name' => 'Arabic', 'local' => 'العربية', 'code' => 'ar_SA'],
        'cs' => ['name' => 'Czech', 'local' => 'Čeština', 'code' => 'cs_CZ'],
        'el' => ['name' => 'Greek', 'local' => 'Ελληνικά', 'code' => 'el_GR'],
        'en' => ['name' => 'English', 'local' => 'English', 'code' => 'en_US'],
        'es' => ['name' => 'Spanish', 'local' => 'Spanish', 'code' => 'es_ES'],
        'he' => ['name' => 'Hebrew', 'local' => 'עברית', 'code' => 'he_IL'],
        'hu' => ['name' => 'Hungarian', 'local' => 'Hungarian', 'code' => 'hu_HU'],
        'id' => ['name' => 'Indonesian', 'local' => 'Bahasa Indonesia', 'code' => 'id_ID'],
        'it' => ['name' => 'Italian', 'local' => 'Italiano', 'code' => 'it_IT'],
        'ja' => ['name' => 'Japanese', 'local' => '日本語', 'code' => 'ja_JP'],
        'nl' => ['name' => 'Dutch', 'local' => 'Nederlands', 'code' => 'nl_NL'],
        'no' => ['name' => 'Norwegian', 'local' => 'Norsk', 'code' => 'no_NO'],
        'pl' => ['name' => 'Polish', 'local' => 'Polski', 'code' => 'pl_PL'],
        'pt' => ['name' => 'Portuguese, Brazilian', 'local' => 'Português Brasileiro', 'code' => 'pt_BR'],
        'ro' => ['name' => 'Romanian', 'local' => 'Română', 'code' => 'ro_RO'],
        'ru' => ['name' => 'Russian', 'local' => 'Русский', 'code' => 'ru_RU'],
        'tr' => ['name' => 'Turkish', 'local' => 'Türkçe', 'code' => 'tr_TR'],
        'uk' => ['name' => 'Ukrainian', 'local' => 'Українська', 'code' => 'uk_UA']
    ];

    public function getLangs()
    {
        $lang_arr = [];
        foreach ($this->lang_obj as $code => $lang) {
            $lang_arr[$code] = $lang['local'];
        }
        return $lang_arr;
    }

    public function getCode($key)
    {
        return $this->lang_obj[$key]['code'];
    }

    public function getLangName($key)
    {
        return $this->lang_obj[$key]['name'];
    }

    public function getLangLocal($key)
    {
        return $this->lang_obj[$key]['local'];
    }

    public function getLang($key)
    {
        return $this->lang_obj[$key];
    }
}
