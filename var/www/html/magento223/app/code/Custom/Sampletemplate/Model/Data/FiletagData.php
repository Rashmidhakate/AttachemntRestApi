<?php

namespace Custom\Sampletemplate\Model\Data;

use \Magento\Framework\Api\AttributeValueFactory;

/**
 * Class Custom Data
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 */
class FiletagData extends \Magento\Framework\Api\AbstractExtensibleObject implements
\Custom\Sampletemplate\Api\Data\FiletagDataInterface
{
	
	/**
	 * Get Id.
	 *
	 * @return int|null
	 */
	public function getFiletagId()
	{
		return $this->_get(self::ID);
	}
	
	/**
	 * Set Id.
	 *
	 * @param int $id
	 * @return $this
	 */
	public function setFiletagId($id = null)
	{
		return $this->setData(self::ID, $id);
	}
	
	/**
	 * Get Customer Id.
	 *
	 * @return int|null
	 */
	public function getFiletagName()
	{
		return $this->_get(self::FILETAG_NAME);
	}
	
	/**
	 * Set Customer Id.
	 *
	 * @param int $customerId
	 * @return $this
	 */
	public function setFiletagName($filetagName = null)
	{
		return $this->setData(self::FILETAG_NAME, $filetagName);
	}
	
	/**
	 * Get Product Id.
	 *
	 * @return int|null
	 */
	public function getFiletagLogo()
	{
		return $this->_get(self::FILETAG_LOGO);
	}
	
	/**
	 * Set Product Id.
	 *
	 * @param int $productId
	 * @return $this
	 */
	public function setFiletagLogo($filetagLogo = null)
	{
		return $this->setData(self::FILETAG_LOGO, $filetagLogo);
	}

}