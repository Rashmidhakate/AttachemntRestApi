<?php

namespace Custom\Sampletemplate\Api\Data;

/**
 * Custom Data interface.
 * @api
 */
interface FiletagDataInterface extends \Magento\Framework\Api\CustomAttributesDataInterface
{
	/**#@+
	 * Constants defined for keys of the data array. Identical to the name of the getter in snake case
	 */
	const ID = 'filetag_id';

	const FILETAG_NAME = 'filetag_name';
	
	const FILETAG_LOGO = 'filetag_logo';
	/**#@-*/

	/**
	 * Get Id.
	 *
	 * @return int|null
	 */
	public function getFiletagId();

	/**
	 * Set FiletagID.
	 *
	 * @param int $id
	 * @return $this
	 */
	public function setFiletagId($id = null);

	/**
	 * Get FiletagName
	 *
	 * @return string|null
	 */
	public function getFiletagName();

	/**
	 * Set FiletagName
	 *
	 * @param string $filetagName
	 * @return $this
	 */
	public function setFiletagName($filetagName = null);
	
	/**
	 * Get FiletagLogo
	 *
	 * @return string|null
	 */
	public function getFiletagLogo();
	
	/**
	 * Set FiletagLogo
	 *
	 * @param string $filetagLogo
	 * @return $this
	 */
	public function setFiletagLogo($filetagLogo = null);
}