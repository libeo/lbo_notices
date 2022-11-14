<?php

namespace Libeo\LboNotices\Middleware;

use Libeo\LboNotices\Domain\Model\Notice;
use Libeo\LboNotices\Domain\Utility;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Context\TypoScriptAspect;
use TYPO3\CMS\Core\Http\RedirectResponse;
use TYPO3\CMS\Core\TypoScript\TemplateService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Redirect implements MiddlewareInterface
{
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $response = $handler->handle($request);

        $typoScript = $this->getTypoScriptSetup();
        $levelRedirect = $typoScript['plugin.']['tx_lbonotices.']['levelRedirect'];
        if (!empty($levelRedirect)) {
            $notices = Utility::getAllActiveNotices();

            /** @var Notice $notice */
            foreach ($notices as $notice) {
                if ($notice->getLevel() === (int) $levelRedirect && $request->getUri()->getPath() !== '/') {
                    return new RedirectResponse('/', 302);
                }
            }
        }

        return $response;
    }

    protected function getTypoScriptSetup(): array
    {
        if (!$GLOBALS['TSFE']->tmpl instanceof TemplateService || empty($GLOBALS['TSFE']->tmpl->setup)) {
            $context = GeneralUtility::makeInstance(Context::class);

            if ($context->getPropertyFromAspect('typoscript', 'forcedTemplateParsing') === false) {
                $context->setAspect('typoscript', new TypoScriptAspect(true));
            }

            $GLOBALS['TSFE']->getConfigArray();
        }

        return $GLOBALS['TSFE']->tmpl->setup;
    }
}
