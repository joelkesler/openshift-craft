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

/**
 * CP functions
 */
class CpVariable
{
	/**
	 * Get the sections of the CP.
	 *
	 * @return array
	 */
	public function nav()
	{
		$nav['dashboard'] = array('name' => Craft::t('Dashboard'));

		if (craft()->sections->getTotalEditableSections())
		{
			$nav['entries'] = array('name' => Craft::t('Entries'));
		}

		$globals = craft()->globals->getEditableSets();

		if ($globals)
		{
			$nav['globals'] = array('name' => Craft::t('Globals'), 'url' => 'globals/'.$globals[0]->handle);
		}

		if (craft()->assetSources->getTotalViewableSources())
		{
			$nav['assets'] = array('name' => Craft::t('Assets'));
		}

		if (craft()->hasPackage(CraftPackage::Users) && craft()->userSession->checkPermission('editUsers'))
		{
			$nav['users'] = array('name' => Craft::t('Users'));
		}

		// Add any Plugin nav items
		$plugins = craft()->plugins->getPlugins();

		foreach ($plugins as $plugin)
		{
			if ($plugin->hasCpSection())
			{
				if (craft()->userSession->checkPermission('accessPlugin-'.$plugin->getClassHandle()))
				{
					$lcHandle = mb_strtolower($plugin->getClassHandle());
					$nav[$lcHandle] = array('name' => $plugin->getName());
				}
			}
		}

		$firstSegment = craft()->request->getSegment(1);

		if ($firstSegment == 'myaccount')
		{
			$firstSegment = 'users';
		}

		foreach ($nav as $handle => &$item)
		{
			$item['sel'] = ($handle == $firstSegment);

			if (isset($item['url']))
			{
				$item['url'] = UrlHelper::getUrl($item['url']);
			}
			else
			{
				$item['url'] = UrlHelper::getUrl($handle);
			}
		}

		return $nav;
	}

	/**
	 * Returns whether the CP alerts are cached.
	 *
	 * @return bool
	 */
	public function areAlertsCached()
	{
		// The license key status gets cached on each Elliott request
		return (craft()->et->getLicenseKeyStatus() !== false);
	}

	/**
	 * Returns an array of alerts to display in the CP.
	 *
	 * @return array
	 */
	public function getAlerts()
	{
		return CpHelper::getAlerts(craft()->request->getPath());
	}
}
