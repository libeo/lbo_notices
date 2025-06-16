<?php
namespace Libeo\LboNotices\ViewHelpers;

use Libeo\LboNotices\Domain\Model\Notice;
use Libeo\LboNotices\Domain\Utility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractConditionViewHelper;

/**
 * Check if notice exist.
 *
 * <notice:ifNotice level="1">
 * <f:cObject typoscriptObjectPath="lib.notices" />
 * </notice:ifNotice>
 */
class IfNoticeViewHelper extends AbstractConditionViewHelper
{
    public function initializeArguments()
    {
        parent::initializeArguments();

        $this->registerArgument('level', 'string', 'Level of alert');
    }

    public static function verdict(array $arguments, RenderingContextInterface $renderingContext): bool
    {
        $level = $arguments['level'] ?? null;
        $notices = Utility::getAllActiveNotices();

        if (!$level && $notices) {
            return true;
        }

        /** @var Notice $notice */
        foreach ($notices as $notice) {
            if ($notice->getLevel() === $level) {
                return true;
            }
        }

        return false;
    }
}
