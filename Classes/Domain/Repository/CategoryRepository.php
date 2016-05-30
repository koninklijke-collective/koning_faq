<?php
namespace Keizer\KoningFaq\Domain\Repository;

/**
 * Repository: Category
 *
 * @package Keizer\KoningFaq\Domain\Repository
 */
class CategoryRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = array('sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);

    /**
     * @param array $uidList
     * @return array
     */
    public function findByUidList(array $uidList)
    {
        $return = array();
        foreach ($uidList as $uid) {
            $return[] = $this->findByUid($uid);
        }
        return $return;
    }
}
