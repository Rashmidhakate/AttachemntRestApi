<?php
namespace Custom\Sampletemplate\Api;
 
interface FiletagInterface {
    /**
	 * Get Filetag Api.
	 *
	 * @param int $id
	 * @return \Custom\Sampletemplate\Api\Data\FiletagDataInterface
	 * @throws \Magento\Framework\Exception\LocalizedException
	 */
    public function getFiletagData($id);


    /**
	 * Create custom Api.
	 *
	 * @param \Custom\Sampletemplate\Api\Data\FiletagDataInterface $entity
	 * @return \Custom\Sampletemplate\Api\Data\FiletagDataInterface
	 * @throws \Magento\Framework\Exception\LocalizedException
	 */
    public function create(
		\Custom\Sampletemplate\Api\Data\FiletagDataInterface $entity
	);

	/**
	 * Update custom Api.
	 *
	 * @param \Custom\Sampletemplate\Api\Data\FiletagDataInterface $entity
	 * @return \Custom\Sampletemplate\Api\Data\FiletagDataInterface 
	 * @throws \Magento\Framework\Exception\LocalizedException
	 */
	public function update(
		\Custom\Sampletemplate\Api\Data\FiletagDataInterface $entity
	);

	/**
	 * Delete custom Api.
	 *
	 * @param int $id
	 * @return bool Will returned True if deleted
	 * @throws \Magento\Framework\Exception\LocalizedException
	 */
	public function delete($id);
}