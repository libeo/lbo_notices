<?php

namespace Libeo\LboNotices\Domain;

use Libeo\LboNotices\Domain\Repository\NoticeRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;

class Utility
{
    // TODO : Ajouter cache sur retour
    public static function getAllActiveNotices()
    {
        $repository = GeneralUtility::makeInstance(NoticeRepository::class);

        /** @var QuerySettingsInterface $querySettings */
        $querySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);
        $querySettings->setRespectStoragePage(false);
        $repository->setDefaultQuerySettings($querySettings);

        return $repository->findAll();
    }
}
