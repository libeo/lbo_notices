<?php
namespace Libeo\LboNotices\Controller;

use Libeo\LboNotices\Domain\Model\Notice;
use Libeo\LboNotices\Domain\Repository\NoticeRepository;
use TYPO3\CMS\Core\Cache\CacheTag;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Psr\Http\Message\ResponseInterface;

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
 * NoticeController
 */
class NoticeController extends ActionController
{

    /**
     * noticeRepository
     *
     * @var NoticeRepository
     */
    protected $noticeRepository = null;

    /**
     * @param NoticeRepository $noticeRepository
     */
    public function injectNoticeRepository(NoticeRepository $noticeRepository)
    {
        $this->noticeRepository = $noticeRepository;
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction(): ResponseInterface
    {
        $currentPage = $this->request->getAttribute('routing')->getPageId();
        $notices = $this->noticeRepository->findAllForPage($currentPage);
        $this->view->assign('notices', $notices);

        $this->addCacheTags($notices->toArray());
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param Notice $notice
     * @return void
     */
    public function showAction(Notice $notice): ResponseInterface
    {
        $this->view->assign('notice', $notice);

        $this->addCacheTags([$notice]);
        return $this->htmlResponse();
    }

    protected function addCacheTags(array $notices): void
    {
        $this->request->getAttribute('frontend.cache.collector')
            ->addCacheTags(new CacheTag('tx_lbonotices_domain_model_notice_all'));

        foreach ($notices as $notice) {
            $this->request->getAttribute('frontend.cache.collector')
                ->addCacheTags(new CacheTag('tx_lbonotices_domain_model_notice_' . $notice->getUid()));
        }
    }
}
