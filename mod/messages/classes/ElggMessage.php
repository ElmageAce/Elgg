<?php

/**
 * Message
 *
 * @property int $toId       Recipient GUID
 * @property int $fromId     Sender GUID
 * @property int $readYet    Has the message been read? 1 = yes
 * @property int $hiddenFrom Has the user deleted the message from their sentbox?
 * @property int $hiddenTo   Has the user deleted the message from their inbox?
 */
class ElggMessage extends ElggObject {

	/**
	 * {@inheritDoc}
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "messages";
	}
}
