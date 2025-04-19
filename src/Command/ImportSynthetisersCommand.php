<?php

namespace App\Command;

use App\Entity\Instrument;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportSynthetisersCommand extends Command
{
    protected static $defaultName = 'app:import-synthetisers';
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    // Configuration de l'import des synthétiseurs
    protected function configure(): void
    {
        $this
            // on définit explicitement le nom de la commande
            ->setName('app:import-synthetisers')
            // on définit une description de la commande    
            ->setDescription('Import synthetisers from a json file')
            ->addArgument(
                'directory',
                InputArgument::OPTIONAL,
                'The path to the json files',
                __DIR__ . '/../../public/json'
            )
    
            ->addArgument(
                'isApproved',
                InputArgument::OPTIONAL,
                'Approval status (true/false)',
                'true'
            )
            ->addArgument(
                'createdAt',
                InputArgument::OPTIONAL,
                'Date de création de l\'instrument',
                null
            );
    }

    // Exécution de la commande
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $directory = $input->getArgument('directory');
        $isApproved = filter_var($input->getArgument('isApproved'), FILTER_VALIDATE_BOOLEAN);
        $createdAtArg = $input->getArgument('createdAt');

        // Récupération des fichiers JSON dans le répertoire
        $files = glob($directory . '/*.json');

        if (empty($files)) {
            $output->writeln('<error>No JSON files found in the specified directory.</error>');
            return Command::FAILURE;
        }

        foreach ($files as $filePath) {
            // Lecture du contenu du fichier JSON
            $jsonContent = file_get_contents($filePath);
            $instruments = json_decode($jsonContent, true);

            if (!$instruments) {
                $output->writeln('<error>Invalid JSON data in file: ' . basename($filePath) . '</error>');
                continue; // Passer au fichier suivant
            }

            // Création de l'entité Instrument et définition des propriétés
            foreach ($instruments as $data) {
                $instrument = new Instrument();
                $instrument->setManufacturer(basename($filePath, '.json')); // Utiliser le nom de fichier sans extension
                // on utilise l'opérateur de coalescence ?? pour fournir une valeur par defaut si la clé n'existe ou est nulle
                $instrument->setNameInstr($data['name'] ?? '');
                $instrument->setTypeInstr($data['type'] ?? '');
                $instrument->setRating($data['rating'] ?? null);
                // On convertit la valeur en entier avant de la passer au setter avec intval
                $instrument->setReviewCount(isset($data['review_count']) ? intval($data['review_count']) : null);
                $instrument->setPictureUrl($data['image_url'] ?? '');
                // idem pour le champ year_instr
                $instrument->setYearInstr(isset($data['year']) ? intval($data['year']) : 0);
                // idem pour le champ  oscillators
                $instrument->setOscillators(isset($data['oscillators']) ? intval($data['oscillators']) : 0);
                $instrument->setEnvelopes(isset($data['envelopes']) ? intval($data['envelopes']) : 0);
                $instrument->setFilterInstr(isset($data['filters'])  ? intval($data['filters']) : 0);
                $instrument->setLfos(isset($data['lfos'])  ? intval($data['lfos']) : 0);
                $instrument->setPolyphony($data['polyphony'] ?? '');
                $instrument->setMultitimbral($data['multitimbral'] ?? '');

                $instrument->setSynthesisType($data['synthesis_types'] ?? []);


                // Champs supplémentaires
                $instrument->setIsApproved($isApproved);

                // Gestion de la date de création
                if ($createdAtArg) {
                    try {
                        $createdAt = new \DateTimeImmutable($createdAtArg);
                    } catch (\Exception $e) {
                        $createdAt = new \DateTimeImmutable();
                    }
                } else {
                    $createdAt = new \DateTimeImmutable();
                }
                $instrument->setCreatedAt($createdAt);

                // Persister l'entité
                $this->entityManager->persist($instrument);
            }
        }
        // Sauvegarder en base
        $this->entityManager->flush();
        $output->writeln('<info>Instruments imported successfully!</info>');
        return Command::SUCCESS;
    }
}
