<?php
namespace Keizer\KoningFaq\Domain\Repository;

/**
 * Repository: Entry
 *
 * @package Keizer\KoningFaq\Domain\Repository
 */
class EntryRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = array('sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);

    /**
     * Searches for entries and groups them by category
     *
     * @param array $categories
     * @param string $searchQuery
     * @return array
     */
    public function search($categories = array(), $searchQuery = '')
    {
        $query = $this->createQuery();
        $constraints = array();
        if ($categories !== array()) {
            $constraints[] = $query->in('category', $categories);
        }
        if (strlen($searchQuery) > 0) {
            $constraints[] = $query->logicalOr(array(
                $query->like('question', '%' . $searchQuery . '%'),
                $query->like('answer', '%' . $searchQuery . '%')
            ));
        }
        if (count($constraints) > 0) {
            $query->matching($query->logicalAnd($constraints));
        }
        return $this->groupByCategory($query->execute());
    }

    /**
     * Groups a result set of entries by categories
     *
     * @param \TYPO3\CMS\Extbase\Persistence\QueryResultInterface $results
     * @return array
     */
    protected function groupByCategory(\TYPO3\CMS\Extbase\Persistence\QueryResultInterface $results)
    {
        $returnArray = array();
        if (count($results) > 0) {
            foreach ($results as $result) {
                /** @var \Keizer\KoningFaq\Domain\Model\Entry $result */
                if (isset($returnArray[$result->getCategory()->getSorting()])) {
                    $returnArray[$result->getCategory()->getSorting()]['entries'][] = $result;
                } else {
                    $returnArray[$result->getCategory()->getSorting()] = array(
                        'category' => $result->getCategory(),
                        'entries' => array($result)
                    );
                }
            }
        }
        ksort($returnArray);
        return $returnArray;
    }
}
