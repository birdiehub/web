<?php

namespace App\Http\Presenters;

trait TranslationPresenter
{
    // records with array of translations
    public function recordsWithTranslations($data): array
    {
        foreach ($data["data"] as $index => $record) {
            $data["data"][$index] = self::recordWithTranslations($record);
        }
        return $data;
    }

    // records with single translation (first translation) -> use where-clause to get specific translation
    public function recordsWithTranslation($data): array
    {
        foreach ($data["data"] as $index => $record) {
            $data["data"][$index]["translation"] = $record["translations"][0] ?? null;
            unset($data["data"][$index]["translations"]);
        }

        return $data;
    }

    // single record with array of translations
    public function recordWithTranslations($data): array
    {
        if (!isset($data["translations"]))
            return $data;

        $translations = [];
        foreach ($data["translations"] as  $translation) {
            $translations[$translation["language"]] = $translation;
        }
        $data["translations"] = $translations;

        return $data;
    }

}
