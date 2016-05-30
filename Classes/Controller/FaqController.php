<?php
namespace Keizer\KoningFaq\Controller;

/**
 * Controller: FAQ
 *
 * @package Keizer\KoningFaq\Controller
 */
class FaqController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \Keizer\KoningFaq\Domain\Repository\EntryRepository
     * @inject
     */
    protected $entryRepository;

    /**
     * @var \Keizer\KoningFaq\Domain\Repository\CategoryRepository
     * @inject
     */
    protected $categoryRepository;

    /**
     * Shows a list of FAQ entries
     *
     * @param \Keizer\KoningFaq\Domain\Model\Category $category
     * @param string $searchQuery
     * @return void
     */
    public function listAction(\Keizer\KoningFaq\Domain\Model\Category $category = null, $searchQuery = '')
    {
        $categories = [];
        $entries = [];

        if ((bool)$this->settings['showAllCategories'] === true) {
            $categories = $this->categoryRepository->findAll()->toArray();
            if ($category !== null) {
                $categories = array($category);
            }
            $entries = $this->entryRepository->search($categories, $searchQuery);
        } elseif (strlen($this->settings['categories']) > 0) {
            $categories = $this->categoryRepository->findByUidList(explode(',', $this->settings['categories']));
            if ($category !== null) {
                $categories = array($category);
            }
            $entries = $this->entryRepository->search($categories, $searchQuery);
        }
        $categories = array_merge([
            '' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('faq.list.all_categories', 'faq')
        ], $categories);

        $this->view->assignMultiple([
            'entries' => $entries,
            'categories' => $categories,
            'selectedCategory' => $category,
            'searchQuery' => $searchQuery,
            'hideSearch' => (bool)$this->settings['hideSearch'],
            'hideCategoryTitle' => (bool)$this->settings['hideCategoryTitle'],
            'activeFilter' => ($category !== null || $searchQuery !== '') ? true : false
        ]);
    }
}
