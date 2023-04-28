<?php

namespace App\Modules\Core\Services;



abstract class TranslationService extends Service
{

    protected function validate(array $data, array $rules, array $rulesTranslation = null) : void
    {
        if ($rulesTranslation !== null) {
            foreach ($data["translations"] ?? [] as $translation) {
                $this->_validator->validate($translation, $rulesTranslation);
            }
        }
        $this->_validator->validate($data, $rules);
    }
}
