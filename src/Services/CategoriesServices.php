<?php
namespace App\Services;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\RequestStack;

//Ce service permet de stocker les categories dans une Session. En gros on creee une session dans laquelle on va stocker les categories.

class CategoriesServices{

    private $repoCat;
    private $requestStack;

    public function __construct(RequestStack $requestStack, CategoryRepository $repoCat)
    {
        $this->repoCat = $repoCat;
        $this->requestStack = $requestStack;
    }

    public function updateSession(){
        $session = $this->requestStack->getSession();
        $categories = $this->repoCat->findAll();
        $session->set("categories", $categories);
    }
}