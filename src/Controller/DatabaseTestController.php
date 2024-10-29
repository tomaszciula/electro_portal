<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DatabaseTestController extends AbstractController
{
    #[Route('/database-test', name: 'database_test')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        try {
            $connection = $entityManager->getConnection();
            $connection->connect();

            if ($connection->isConnected()) {
                return new Response('Połączenie z bazą danych działa poprawnie.');
            }
        } catch (\Exception $e) {
            return new Response('Błąd połączenia: ' . $e->getMessage());
        }

        return new Response('Połączenie z bazą danych nie powiodło się.');
    }
}