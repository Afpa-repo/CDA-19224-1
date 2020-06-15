<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Faker;

abstract class BaseFixture extends Fixture
{
    /* @var Faker\Generator */
    protected $faker;
    /* @var ObjectManager */
    private $manager;
    /* @var array */
    private $referencesIndex = [];

    // Implements the load method from the Fixture's abstract class
    // It is also used as a constructor
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->faker = Faker\Factory::create('fr_FR');

        // Executes the loadData function implemented by the user
        $this->loadData($manager);
    }

    abstract protected function loadData(ObjectManager $manager);

    /**
     * Creates many entities with the given function.
     *
     * @param string   $className Name of the class
     * @param int      $count     Number of entities to create
     * @param callable $factory   A function that will be used to create the entity
     */
    protected function createMany(string $className, int $count, callable $factory)
    {
        // Until the given count is reached
        for ($i = 0; $i < $count; ++$i) {
            // Creates a new instance of the class given by the user
            $entity = new $className();
            // Applies the function given by the user on the current entity
            $factory($entity, $i);
            // Persists the current entity
            $this->manager->persist($entity);
            // Add a reference for the current entity in the format App\Entity\ClassName_#COUNT#
            $this->addReference($className.'_'.$i, $entity);
        }
    }

    /**
     * Returns a random reference for the given class.
     *
     * @throws Exception If it can't find the reference for the given class
     *
     * @return object A random reference for the given class
     */
    protected function getRandomReference(string $className)
    {
        // If the references array don't have an entry with the given className
        if (!isset($this->referencesIndex[$className])) {
            // Initialize the array for the given className with an empty array
            $this->referencesIndex[$className] = [];

            // Foreach references in the fixture repository for the given className
            foreach ($this->referenceRepository->getReferences() as $key => $ref) {
                // If the reference key contains the substring at the first position
                if (0 === strpos($key, $className.'_')) {
                    // Push the key in the references array for the given className
                    $this->referencesIndex[$className][] = $key;
                }
            }
        }

        // If the references array with the given className as the entry is empty
        if (empty($this->referencesIndex[$className])) {
            // Throw an exception
            throw new Exception(sprintf('Cannot find any references for class "%s"', $className));
        }

        // Returns a random element in the references array with the given className
        $randomReferenceKey = $this->faker->randomElement($this->referencesIndex[$className]);

        // Returns the reference of the random element given by the randomReferenceKey
        return $this->getReference($randomReferenceKey);
    }
}
