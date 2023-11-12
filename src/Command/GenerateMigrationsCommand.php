<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:generate-migrations',
    description: 'Generates Doctrine migration files with random years in their timestamps',
)]
class GenerateMigrationsCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addArgument('numMigrations', InputArgument::REQUIRED, 'The number of migration files to generate')
            ->addArgument('startYear', InputArgument::REQUIRED, 'The start year for random timestamp generation')
            ->addArgument('endYear', InputArgument::REQUIRED, 'The end year for random timestamp generation')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $numMigrations = $input->getArgument('numMigrations');
        $startYear = $input->getArgument('startYear');
        $endYear = $input->getArgument('endYear');

        for ($i = 0; $i < $numMigrations; $i++) {
            $year = rand($startYear, $endYear);
            $date = new \DateTime();
            $date->setDate($year, rand(1, 12), rand(1, 28)); // Random day and month
            $timestamp = $date->format('YmdHis');
            $className = 'Version' . $timestamp;
            $filename = sprintf('Version%s.php', $timestamp);

            file_put_contents(
                $this->getMigrationDirectory() . '/' . $filename,
                $this->getMigrationFileContent($className)
            );

            $io->success("Created migration file: $filename");
        }

        return Command::SUCCESS;
    }

    private function getMigrationDirectory(): string
    {
        // Update with the path to your migrations directory
        return 'migrations';
    }

    private function getMigrationFileContent(string $className): string
    {
        return <<<EOT
<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class $className extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema \$schema): void
    {
        // migration up logic
    }

    public function down(Schema \$schema): void
    {
        // migration down logic
    }
}

EOT;
    }
}

