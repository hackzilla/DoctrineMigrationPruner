# Doctrine Migration Prunering

## Overview
This example application is designed for demonstration, testing, and educational purposes. It showcases the functionality of the `hackzilla/doctrine-migration-pruner-bundle`, a tool for managing and pruning old Doctrine migration files.

## Features
- Generates fake Doctrine migration files with random timestamps.
- Demonstrates the automatic pruning of old migration files by the `hackzilla/doctrine-migration-pruner-bundle`.
- Useful for understanding how the bundle operates in a real-world scenario.

## Prerequisites
- Doctrine Migration Bundle v3.
- MySQL or Sqlite

The system is currently configured for Sqlite.

## Installation
Use composer to install the necessary dependencies:

```bash
composer install
```

## Configuration
To configure the `hackzilla_doctrine_migration_pruner` in your Symfony application, add the following to your `config/packages/hackzilla_doctrine_migration_pruner.yaml` file:

```yaml
hackzilla_doctrine_migration_pruner:
  remove_migrations_before: '2007-05-01'  # Can be null or a valid date-time
```

## Usage
### Generating Migrations
Run the custom Symfony command to generate migration files:

```bash
bin/console app:generate-migrations [numMigrations] [startYear] [endYear]
```

- `numMigrations`: The number of migration files to generate.
- `startYear`: The start year for random timestamp generation.
- `endYear`: The end year for random timestamp generation.

To create 30 migrations between 2019 and 2025:

```bash
bin/console app:generate-migrations 30 2019 2025
```

### Running Migrations
Execute your Doctrine migrations as usual:

```bash
bin/console doctrine:migrations:migrate
```

The pruning operation will automatically occur, removing old migration files and their corresponding database entries.

## Testing
This application provides a hands-on way to test and observe the `hackzilla/doctrine-migration-pruner-bundle` in action.

## Contributions and Issues
See all contributors on [GitHub](https://github.com/hackzilla/DoctrineMigrationPruner/graphs/contributors).

Please report issues using GitHub's issue tracker: [GitHub Repo](https://github.com/hackzilla/DoctrineMigrationPruner)

Alertnatively, if have issues with the bundle, please report issues with the bundle issue tracker: [GitHub Repo](https://github.com/hackzilla/DoctrineMigrationPrunerBundle)

If you find this project useful, consider [buying me a coffee](https://www.buymeacoffee.com/hackzilla).

## License

This application is released under the MIT license. See the [LICENSE](https://github.com/hackzilla/DoctrineMigrationPruner/blob/main/LICENSE) file for details.
