<?php

namespace App\Service\Categories;

use App\Repository\Ct404CategoryRepository;
use App\Repository\Ct404SubCategoryRepository;

class CategoriesManagement
{
    /**
     * @var Ct404CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var Ct404SubCategoryRepository
     */
    private $subCategoryRepository;

    /**
     * CategoriesManagement constructor.
     */
    public function __construct(Ct404CategoryRepository $categoryRepository, Ct404SubCategoryRepository $subCategoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
    }

    public function getCategoriesNavBar()
    {
        return $this->categoryRepository->findAll();
    }

    public function getSubCategoriesNavBar($category_id)
    {
        return $this->subCategoryRepository->findBy([
            'category' => $category_id,
        ]);
    }
}
