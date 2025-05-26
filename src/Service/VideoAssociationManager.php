<?php

namespace App\Service;

use App\Entity\Instrument;
use App\Entity\SelectedVideo;
use App\Entity\User;
use App\Entity\Role;
use Doctrine\ORM\EntityManagerInterface;

class VideoAssociationManager
{
    public function associate(Instrument $instrument, SelectedVideo $video, User $user, EntityManagerInterface $em): void
    {
        // Règle métier : une vidéo ne peut être associée qu'une fois à un instrument
        foreach ($instrument->getSelectedVideos() as $existingVideo) {
            if ($existingVideo->getVideoId() === $video->getVideoId()) {
                throw new \LogicException('Cette vidéo est déjà associée à cet instrument.');
            }
        }

        // Règle métier : pas plus de 3 vidéos par instrument
        if (count($instrument->getSelectedVideos()) >= 3) {
            throw new \LogicException('Un instrument ne peut avoir que 3 vidéos maximum.');
        }

        $video->setInstrument($instrument);
        $video->setUser($user);

        // Promotion de l'utilisateur au rôle ROLE_CREAT s'il a déjà ROLE_USER
        $roleUser = $em->getRepository(Role::class)->findOneBy(['nameRole' => 'ROLE_USER']);
        $roleCreat = $em->getRepository(Role::class)->findOneBy(['nameRole' => 'ROLE_CREAT']);

        if ($roleUser && $user->getRolesCollection()->contains($roleUser)) {
            if ($roleCreat && !$user->getRolesCollection()->contains($roleCreat)) {
                $user->addRole($roleCreat);
                $em->persist($user);
            }
        }
    }
}
