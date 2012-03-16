<?php

/**
 * This file is part of the Country List project.
 *
 *  (c) Саша Стаменковић <umpirsky@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Umpirsky\Country\Builder;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Umpirsky\Country\Dumper\Iterator as DumperIterator;
use Umpirsky\Country\Importer\Iterator as ImporterIterator;

/**
 * Command to build country files.
 *
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
class Build extends Command {

    /**
     * Base path to build files.
     *
     * @var string
     */
    protected $path;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var DumperIterator
     */
    protected $dumperIterator;

    /**
     * @var ImporterIterator
     */
    protected $importerIterator;

    /**
     * Build command constructor.
     *
     * @param string $path base path to build files
     */
    public function __construct($path) {

        parent::__construct('build');
        $this->filesystem = new Filesystem();
        $this->filesystem->mkdir($this->path = $path);
        $this->dumperIterator = new DumperIterator();
        $this->importerIterator = new ImporterIterator();
    }

   /**
    * {@inheritdoc}
    */
    protected function configure() {

        $this
            ->setDescription('Builds country list files.')
            ->setDefinition(array(
                new InputArgument('source', InputArgument::OPTIONAL, 'Data source to fetch countries from'),
                new InputArgument('language', InputArgument::OPTIONAL, 'Language'),
                new InputArgument('format', InputArgument::OPTIONAL, 'Format in which to export data')
            ))
            ->setHelp(sprintf(
                    '%sBuilds country list files.%s',
                    PHP_EOL,
                    PHP_EOL
            ));
    }

   /**
    * {@inheritdoc}
    */
    protected function execute(InputInterface $input, OutputInterface $output) {

        foreach ($this->importerIterator as $importer) {
            if (null === $input->getArgument('source') || $input->getArgument('source') === $importer->getSource()) {
                $this->filesystem->mkdir($importerDir = sprintf('%s/%s', $this->path, $importer->getSource()));
                foreach ($importer->getLanguages() as $language) {
                    if (null === $input->getArgument('language') || $input->getArgument('language') === $language) {
                        $this->filesystem->mkdir($dumperDir = sprintf('%s/%s', $importerDir, $language));
                        $countries = $importer->getCountries($language);
                        foreach($this->dumperIterator as $dumper) {
                            if (null === $input->getArgument('format') || $input->getArgument('format') === $dumper->getFormat()) {
                                $file = sprintf('%s/country.%s', $dumperDir, $dumper->getFormat());
                                $this->filesystem->touch($file);
                                file_put_contents($file, $dumper->dump($countries));
                                $output->write(sprintf('File %s is generated.%s', $file, PHP_EOL));
                            }
                        }
                    }
                }
            }
        }
    }
}
