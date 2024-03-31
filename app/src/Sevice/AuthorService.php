<?php 

namespace App\Service;
use Symfony\Component\DependencyInjection\Loader\Configurator\AbstractServiceConfigurator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AuthorRepository;
use App\Entity\Factory\AuthorFactory;

class AuthorService extends AbstractServiceConfigurator
{
    public function __construct(private AuthorFactory $authorFactory, private AuthorRepository $useAuthorRepository) {
    }

    public function create(Request $request): Response
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

    public function delete(Request $request): Response
    {
        $id = $request->attributes->get('id');
        return $this->useAuthorRepository->removeAuthor($id);
    }
}