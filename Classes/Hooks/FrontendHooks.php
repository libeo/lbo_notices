<?php

namespace Libeo\LboNotices\Hooks;

use Libeo\LboNotices\Domain\Model\Notice;
use Libeo\LboNotices\Domain\Repository\NoticeRepository;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

class FrontendHooks
{
    public function determineCacheTimeout($params, $tsfe)
    {
        $timeouts = [$params['cacheTimeout']];

        /** @var NoticeRepository $noticeRepository */
        $noticeRepository = GeneralUtility::makeInstance(ObjectManager::class)
            ->get(NoticeRepository::class);

        /** @var null|Notice $notice */
        $notices = $noticeRepository->getByPageId($tsfe->id);

        if ($notices->count()) {
            $now = $GLOBALS['ACCESS_TIME'];
            foreach ($notices as $notice) {
                if (($starttime = $notice->getStarttime()) && $starttime->getTimestamp() > $now) {
                    $timeouts[] = $starttime->getTimestamp() - $now;
                }if (($endtime = $notice->getEndtime()) && $endtime->getTimestamp() > $now) {
                    $timeouts[] = $endtime->getTimestamp() - $now;
                }
            }
        }

        return min($timeouts);
    }

    public function clearCachePostProc(array $params)
    {
        if ($params['table'] === 'tx_lbonotices_domain_model_notice') {
            /** @var NoticeRepository $noticeRepository */
            $noticeRepository = GeneralUtility::makeInstance(ObjectManager::class)
                ->get(NoticeRepository::class);

            /** @var null|Notice $notice */
            $notice = $noticeRepository->getByid($params['uid']);

            $cacheTags = ['tx_lbonotices_domain_model_notice_' . $params['uid']];
            if ($notice) {
                foreach ($notice->getPagesIds() as $id) {
                    $cacheTags[] = 'pageId_' . $id;
                }
                if (empty($notice->getPagesIds())) {
                    $cacheTags[] = 'tx_lbonotices_domain_model_notice_all';
                }
            }

            /** @var CacheManager $cacheManager */
            $cacheManager = GeneralUtility::makeInstance(CacheManager::class);
            $cacheManager->flushCachesInGroupByTags('pages', $cacheTags);
        }
    }
}
