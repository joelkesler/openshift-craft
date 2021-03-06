<?php
namespace Craft;

/**
 * Craft by Pixel & Tonic
 *
 * @package   Craft
 * @author    Pixel & Tonic, Inc.
 * @copyright Copyright (c) 2013, Pixel & Tonic, Inc.
 * @license   http://buildwithcraft.com/license Craft License Agreement
 * @link      http://buildwithcraft.com
 */

craft()->requirePackage(CraftPackage::PublishPro);

/**
 *
 */
class EntryRevisionsVariable
{
	// -------------------------------------------
	//  Drafts
	// -------------------------------------------

	/**
	 * Returns entry drafts by an entry ID.
	 *
	 * @param int $entryId
	 * @param string $localeId
	 * @return array
	 */
	public function getDraftsByEntryId($entryId, $localeId = null)
	{
		return craft()->entryRevisions->getDraftsByEntryId($entryId, $localeId);
	}

	/**
	 * Returns the drafts of a given entry that are editable by the current user.
	 *
	 * @param int $entryId
	 * @param string $localeId
	 * @return array
	 */
	public function getEditableDraftsByEntryId($entryId, $localeId = null)
	{
		return craft()->entryRevisions->getEditableDraftsByEntryId($entryId, $localeId);
	}

	/**
	 * Returns an entry draft by its offset.
	 *
	 * @param $draftId
	 * @return EntryDraftModel|null
	 */
	public function getDraftById($draftId)
	{
		return craft()->entryRevisions->getDraftById($draftId);
	}

	/**
	 * Returns an entry draft by its offset.
	 *
	 * @param int $entryId
	 * @param int $offset
	 * @return EntryDraftModel|null
	 */
	public function getDraftByOffset($entryId, $offset = 0)
	{
		return craft()->entryRevisions->getDraftByOffset($entryId, $offset);
	}

	// -------------------------------------------
	//  Versions
	// -------------------------------------------

	/**
	 * Returns entry versions by an entry ID.
	 *
	 * @param int $entryId
	 * @param string $localeId
	 * @return array
	 */
	public function getVersionsByEntryId($entryId, $localeId)
	{
		return craft()->entryRevisions->getVersionsByEntryId($entryId, $localeId, 10);
	}

	/**
	 * Returns an entry version by its ID.
	 *
	 * @param $versionId
	 * @return EntryVersionModel|null
	 */
	public function getVersionById($versionId)
	{
		return craft()->entryRevisions->getVersionById($versionId);
	}

	/**
	 * Returns an entry version by its offset.
	 *
	 * @param int $entryId
	 * @param int $offset
	 * @return EntryVersionModel|null
	 */
	public function getVersionByOffset($entryId, $offset = 0)
	{
		return craft()->entryRevisions->getVersionByOffset($entryId, $offset);
	}
}
