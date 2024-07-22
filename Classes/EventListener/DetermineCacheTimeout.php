<?php

namespace Libeo\LboNotices\EventListener;

use Libeo\LboNotices\Domain\Model\Notice;
use Libeo\LboNotices\Domain\Repository\NoticeRepository;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Event\ModifyCacheLifetimeForPageEvent;

class DetermineCacheTimeout
{
    public function __invoke(ModifyCacheLifetimeForPageEvent $event): void
    {
        $timeouts = [$event->getCacheLifetime()];

        /** @var NoticeRepository $noticeRepository */
        $noticeRepository = GeneralUtility::makeInstance(NoticeRepository::class);

        /** @var null|Notice $notice */
        $notices = $noticeRepository->getByPageId($event->getPageId());

        if ($notices->count()) {
            $now = GeneralUtility::makeInstance(Context::class)->getPropertyFromAspect('date', 'timestamp');
            foreach ($notices as $notice) {
                if (($starttime = $notice->getStarttime()) && $starttime->getTimestamp() > $now) {
                    $timeouts[] = $starttime->getTimestamp() - $now;
                }
                if (($endtime = $notice->getEndtime()) && $endtime->getTimestamp() > $now) {
                    $timeouts[] = $endtime->getTimestamp() - $now;
                }
            }
            $event->setCacheLifetime(min($timeouts));
        }
    }
}
