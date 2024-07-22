<?php
namespace Libeo\LboNotices\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\Repository;

/***
 *
 * This file is part of the "Notices" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 Pierre Boivin <pierre.boivin@libeo.com>, Libéo
 *
 ***/
/**
 * The repository for Notices
 */
class NoticeRepository extends Repository
{
    public function findAllForPage($pageUid)
    {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalOr(
                $query->contains('pages', $pageUid),
                $query->equals('pages', '')
            )
        );

        return $query->execute();
    }

    /**
     * Return last notice by
     * @param $pageUid
     * @return object[]|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * @throws InvalidQueryException
     */
    public function getByPageId($pageUid)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()
            ->setRespectStoragePage(false)
            ->setIgnoreEnableFields(true);

        return $query
            ->matching(
                $query->logicalOr(
                    $query->contains('pages', $pageUid),
                    $query->equals('pages', '')
                )
            )->execute();
    }

    public function getById($uid)
    {
        $query = $this->createQuery();
        $query->setQuerySettings(
            $query->getQuerySettings()
                ->setRespectStoragePage(false)
                ->setIgnoreEnableFields(true)
                ->setRespectSysLanguage(false)
        );

        $query
            ->matching($query->equals('uid', $uid))
            ->setLimit(1);

        return $query->execute()->getFirst();
    }
}
