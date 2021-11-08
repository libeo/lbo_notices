<?php
namespace Libeo\LboNotices\Controller;

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
class NoticeController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * noticeRepository
     *
     * @var \Libeo\LboNotices\Domain\Repository\NoticeRepository
     */
    protected $noticeRepository = null;

    /**
     * @param \Libeo\LboNotices\Domain\Repository\NoticeRepository $noticeRepository
     */
    public function injectNoticeRepository(\Libeo\LboNotices\Domain\Repository\NoticeRepository $noticeRepository)
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
        $notices = $this->noticeRepository->findAll();
        $this->view->assign('notices', $notices);
    }

    /**
     * action show
     *
     * @param \Libeo\LboNotices\Domain\Model\Notice $notice
     * @return void
     */
    public function showAction(\Libeo\LboNotices\Domain\Model\Notice $notice)
    {
        $this->view->assign('notice', $notice);
    }
}
