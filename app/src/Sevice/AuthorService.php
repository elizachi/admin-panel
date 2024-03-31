<?php 

namespace App\Service;
use Symfony\Component\DependencyInjection\Loader\Configurator\AbstractServiceConfigurator;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AuthorRepository;
use App\Entity\Factory\AuthorFactory;

class AuthorService extends AbstractServiceConfigurator
{
    public function __construct(private AuthorFactory $authorFactory, private AuthorRepository $useAuthorRepository) {
    }

    public function create(Request $request)
    {
        $name = $request->request->get('name');
        $surname = $request->request->get('surname');
        $patronymic = $request->request->get('patronymic');

        $author = $this->authorFactory->newAuthorInstance($name, $surname, $patronymic);

        $this->useAuthorRepository->addAuthor($author);
    }

    public function getAll(): array
    {
        return $this->useAuthorRepository->getAllAuthors();
    }

    public function delete(Request $request)
    {
        $id = $request->attributes->get('id');
        $this->useAuthorRepository->delete($id);
    }
}