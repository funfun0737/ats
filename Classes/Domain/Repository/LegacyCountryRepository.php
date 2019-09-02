<?php
namespace PAGEmachine\Ats\Domain\Repository;

use PAGEmachine\Ats\Service\IntlLocalizationService;

/*
 * This file is part of the PAGEmachine ATS project.
 */

/**
 * Repository for country data (static info tables) - Legacy version for TYPO3 7 without doctrine
 */
class LegacyCountryRepository
{
    public function findAll()
    {
        $countries = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
            implode(',', ['uid', 'cn_iso_2', 'cn_iso_3', 'cn_short_en']),
            'static_countries',
            'deleted = 0'
        );

        $localizationService = IntlLocalizationService::getInstance();

        foreach ($countries as $key => $country) {
            $countries[$key]['localizedName'] = $localizationService->getLocalizedRegionName($country['cn_iso_2']) ?: $country['cn_short_en'];
        }

        return $countries;
    }

    /**
     * Finds languages by their respective uids
     *
     * @param array $uids
     * @return array $countries
     */
    public function findCountriesByUids($uids = [])
    {
        $countries = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
            implode(',', ['uid', 'cn_iso_2', 'cn_iso_3', 'cn_short_en']),
            'static_countries',
            'deleted = 0 AND uid IN(' . implode(',', $uids) . ')'
        );

        $localizationService = IntlLocalizationService::getInstance();

        foreach ($countries as $key => $country) {
            $countries[$key]['localizedName'] = $localizationService->getLocalizedRegionName($country['cn_iso_2']) ?: $country['cn_short_en'];
        }

        return $countries;
    }

    public function findCountriesByISO3($isoCodes = [])
    {
        $isoCodes = array_map(function ($value) {
            return sprintf('"%s"', trim($value));
        }, $isoCodes);

        $countries = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
            implode(',', ['uid', 'cn_iso_2', 'cn_iso_3', 'cn_short_en']),
            'static_countries',
            'deleted = 0 AND cn_iso_3 IN(' . implode(',', $isoCodes) . ')'
        );

        $localizationService = IntlLocalizationService::getInstance();

        foreach ($countries as $key => $country) {
            $countries[$key]['localizedName'] = $localizationService->getLocalizedRegionName($country['cn_iso_2']) ?: $country['cn_short_en'];
        }

        return $countries;
    }

    public function findOneByIsoCodeA3($isoCode)
    {
        $country = $GLOBALS['TYPO3_DB']->exec_SELECTgetSingleRow(
            implode(',', ['uid', 'cn_iso_2', 'cn_iso_3', 'cn_short_en']),
            'static_countries',
            'deleted = 0 AND uid = ' . $isoCode
        );

        $localizationService = IntlLocalizationService::getInstance();
        $country['localizedName'] = $localizationService->getLocalizedRegionName($country['cn_iso_2']) ?: $country['cn_short_en'];

        return $country;
    }
}