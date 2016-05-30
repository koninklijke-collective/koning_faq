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
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByUidList(array $uidList)
    {
        $query = $this->createQuery();
        $constraints = [];
        $constraints[] = $query->in('uid', $uidList);
        return $query->matching($query->logicalAnd($constraints))->execute();
    }
}
