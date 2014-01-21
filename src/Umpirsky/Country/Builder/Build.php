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
use Umpirsky\Country\Exporter\Iterator as ExporterIterator;
use Umpirsky\Country\Importer\Iterator as ImporterIterator;

/**
 * Command to build country files.
 *
 * @author Саша Стаменковић <umpirsky@gmail.com>
 */
class Build extends Command
{
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
     * @var ExporterIterator
     */
    protected $exporterIterator;

    /**
     * @var ImporterIterator
     */
    protected $importerIterator;

    /**
     * Build command constructor.
     *
     * @param string $path base path to build files
     */
    public function __construct($path)
    {
        parent::__construct('build');
        $this->filesystem = new Filesystem();
        $this->filesystem->mkdir($this->path = $path);
        $this->exporterIterator = new ExporterIterator();
        $this->importerIterator = new ImporterIterator();
    }

   /**
    * {@inheritdoc}
    */
    protected function configure()
    {
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
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $verbose = $input->getOption('verbose');
        foreach ($this->importerIterator as $importer) {
            if (null === $input->getArgument('source') || $input->getArgument('source') === $importer->getSource()) {
                $this->filesystem->mkdir($importerDir = $this->path.'/'.$importer->getSource());
                foreach ($importer->getLanguages() as $language) {
                    if (null === $input->getArgument('language') || $input->getArgument('language') === $language) {
                        $this->filesystem->mkdir($exporterDir = $importerDir.'/'.$language);
                        $countries = $importer->getCountries($language);
                        if (!is_array($countries)) {
                            continue;
                        }
                        foreach ($this->exporterIterator as $exporter) {
                            if (null === $input->getArgument('format') || $input->getArgument('format') === $exporter->getFormat()) {
                                $file = $exporterDir.'/country.'.$exporter->getFormat();
                                $this->filesystem->touch($file);
                                file_put_contents($file, $exporter->export($countries));
                                if ($verbose) {
                                    $output->write('<info>[file+]</info> '.$file.PHP_EOL);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
