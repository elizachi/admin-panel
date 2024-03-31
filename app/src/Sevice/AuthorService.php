<?php 

namespace App\Service;
use Symfony\Component\DependencyInjection\Loader\Configurator\AbstractServiceConfigurator;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AuthorRepository;
use App\Entity\Factory\AuthorFactory;
use App\Entity\Author;

class AuthorService extends AbstractServiceConfigurator
{
    public function __construct(private AuthorFactory $authorFactory, private AuthorRepository $useAuthorRepository) {
    }

    public function create(Request $request): Author
    {
        $name = $request->request->get('name');
        $surname = $request->request->get('surname');
        $patronymic = $request->request->get('patronymic');

        $author = $this->authorFactory->newAuthorInstance($name, $surname, $patronymic);

        return $this->useAuthorRepository->addAuthor($author);
    }

    public function getAll(): array
    {
        return $this->useAuthorRepository->getAllAuthors();
    }

    public function delete(Request $request): void
    {
        $id = $request->attributes->get('id');
        $this->useAuthorRepository->removeAuthor($id);
    }
}