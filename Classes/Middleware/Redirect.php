<?php

namespace Libeo\LboNotices\Middleware;

use Libeo\LboNotices\Domain\Model\Notice;
use Libeo\LboNotices\Domain\Utility;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\RedirectResponse;

class Redirect implements MiddlewareInterface
{
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $response = $handler->handle($request);

        $typoScript = $this->getTypoScriptSetup();
        if ($typoScript) {
            $levelRedirect = $typoScript['plugin.']['tx_lbonotices.']['levelRedirect'] ?? null;
            if (!empty($levelRedirect)) {
                $notices = Utility::getAllActiveNotices();

                /** @var Notice $notice */
                foreach ($notices as $notice) {
                    if ($notice->getLevel() === (int) $levelRedirect && $request->getUri()->getPath() !== '/') {
                        return new RedirectResponse('/', 302);
                    }
                }
            }
        }

        return $response;
    }

    protected function getTypoScriptSetup(): ?array
    {
        $frontendTS = $GLOBALS['TYPO3_REQUEST']->getAttribute('frontend.typoscript');

        return $frontendTS->hasSetup() ? $frontendTS->getSetupArray() : null;
    }
}
