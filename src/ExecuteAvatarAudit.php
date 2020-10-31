<?php

namespace Yosmy;

use Yosmy;
use LogicException;

/**
 * @di\service()
 */
class ExecuteAvatarAudit implements Yosmy\ExecuteAudit
{
    /**
     * @var AuditMissingAvatars
     */
    private $auditMissingAvatars;

    /**
     * @var AuditExtraAvatars
     */
    private $auditExtraAvatars;

    /**
     * @var Yosmy\ManagePasswordCollection
     */
    private $managePasswordCollection;

    /**
     * @param AuditMissingAvatars      $auditMissingAvatars
     * @param AuditExtraAvatars        $auditExtraAvatars
     * @param ManagePasswordCollection $managePasswordCollection
     */
    public function __construct(
        AuditMissingAvatars $auditMissingAvatars,
        AuditExtraAvatars $auditExtraAvatars,
        ManagePasswordCollection $managePasswordCollection
    ) {
        $this->auditMissingAvatars = $auditMissingAvatars;
        $this->auditExtraAvatars = $auditExtraAvatars;
        $this->managePasswordCollection = $managePasswordCollection;
    }

    /**
     */
    public function execute()
    {
        $missing = iterator_count($this->auditMissingAvatars->audit(
            $this->managePasswordCollection
        ));

        if ($missing) {
            throw new LogicException();
        }

        $extra = iterator_count($this->auditExtraAvatars->audit(
            $this->managePasswordCollection
        ));

        if ($extra) {
            throw new LogicException();
        }
    }
}