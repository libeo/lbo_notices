<?php
namespace Libeo\LboNotices\Controller;

use Libeo\LboNotices\Domain\Model\Notice;
use Libeo\LboNotices\Domain\Repository\NoticeRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

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
    public function listAction()
    {
        $notices = $this->noticeRepository->findAllForPage($this->getTSFE()->id);
        $this->view->assign('notices', $notices);

        $this->addCacheTags($notices->toArray());
    }

    /**
     * action show
     *
     * @param Notice $notice
     * @return void
     */
    public function showAction(Notice $notice)
    {
        $this->view->assign('notice', $notice);

        $this->addCacheTags([$notice]);
    }

    protected function addCacheTags(array $notices)
    {
        $this->getTSFE()->addCacheTags(['tx_lbonotices_domain_model_notice_all']);
        foreach ($notices as $notice) {
            $this->getTSFE()->addCacheTags(['tx_lbonotices_domain_model_notice_' . $notice->getUid()]);
        }
    }

    /**
     * @return TypoScriptFrontendController
     */
    protected function getTSFE()
    {
        return $GLOBALS['TSFE'];
    }
}
