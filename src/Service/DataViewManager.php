<?php

namespace App\Service;

use App\Entity\DataView;
use App\Entity\User;
use App\Repository\DataViewRepository;
use Doctrine\ORM\EntityManagerInterface;

class DataViewManager
{
    public const USER = 'user';
    public const PERSON = 'person';
    public const COMPANY = 'company';

    public function __construct(private DataViewRepository $repository, private EntityManagerInterface $em)
    {
    }

    public function getDefaults(string $type): array
    {
        $defaults = [];
        switch ($type) {
            case self::USER:
                $defaults = [
                    'title' => 'User',
                    'gridlist' => 'list',
                    'searchProbs' =>
                        ['username', 'email']
                ];
                break;
            case self::PERSON:
                $defaults = [
                    'title' => 'Person',
                    'gridlist' => 'list',
                    'searchProbs' =>
                        ['family_name']
                ];
                break;
            case self::COMPANY:
                $defaults = [
                    'title' => 'Company',
                    'gridlist' => 'list',
                    'searchProbs' =>
                        ['name']
                ];
                break;
        }

        return $defaults;
    }
    public function setDataView(User $user, ?string $type): DataView
    {
        $dataView = $this->repository->findOneBy(['user' => $user, 'type' => $type]);
        if (!$dataView) {
            $defaults = $this->getDefaults($type);
            $dataView = new DataView();
            $dataView->setType($type)
                ->setTitle($defaults['title'])
                ->setGridlist($defaults['gridlist'])
                ->setSearchProbs($defaults['searchProbs'])
                ->setUser($user)
                ->setCreateAt(new \DateTimeImmutable())
                ->setUpdateAt(new \DateTimeImmutable());
            $this->em->persist($dataView);
            $this->em->flush();
        }
        return $dataView;
    }

    public function updateDataView(DataView $dataView): void
    {
        $dataView->setUpdateAt(new \DateTimeImmutable());
        $this->em->flush();
    }
}
