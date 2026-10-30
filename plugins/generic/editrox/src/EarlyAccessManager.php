<?php

namespace APP\plugins\generic\editrox\src;

class EarlyAccessManager {
    public function processOnlineFirst($publication) {
        if (!$publication->getData('issueId')) {
            $publication->setData('isEarlyAccess', true);
            $publication->setData('pub-id::publisher-id', 'in-press-' . $publication->getId());
        }
    }
}
