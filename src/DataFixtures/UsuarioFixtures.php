<?php

namespace App\DataFixtures;

use App\Entity\Usuario;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class UsuarioFixtures
 * @package App\DataFixtures
 */
class UsuarioFixtures extends Fixture
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $usuario = new Usuario();
        $usuario
            ->setUsername('usuario')
            ->setPassword(
                '$argon2id$v=19$m=65536,t=4,p=1$VDFmcjJidFVRSy96em1SZA$5azNABpgFT/T8sZrJfREQBbT9qC+SKuSIKWSfNi6C6E'
            );

        $manager->persist($usuario);
        $manager->flush();
    }
}
