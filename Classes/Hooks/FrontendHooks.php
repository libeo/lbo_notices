<?php

namespace Libeo\LboNotices\Hooks;

use Libeo\LboNotices\Domain\Model\Notice;
use Libeo\LboNotices\Domain\Repository\NoticeRepository;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class FrontendHooks
{
    public function clearCachePostProc(array $params)
    {
        if (($parameters['table'] ?? '') === 'tx_lbonotices_domain_model_notice') {
            /** @var NoticeRepository $noticeRepository */
            $noticeRepository = GeneralUtility::makeInstance(NoticeRepository::class);

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
