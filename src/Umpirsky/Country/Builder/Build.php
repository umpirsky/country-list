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
use Symfony\Component\Console\Input\InputOption;
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
        $this->exporterIterator = new ExporterIterator();
        $this->importerIterator = new ImporterIterator();
        $this->path = $path;
    }

   /**
    * {@inheritdoc}
    */
    protected function configure()
    {
        $this
            ->setDescription('Builds country list files.')
            ->setDefinition(array(
                new InputArgument('source', InputArgument::OPTIONAL, 'Data source to fetch countries from (cldr, icu)'),
                new InputArgument('format', InputArgument::OPTIONAL, 'Format in which to export data, no value means all formats'),
                new InputArgument('language', InputArgument::OPTIONAL, 'Language, no value means all languages'),
                new InputOption('path', 'p', InputOption::VALUE_OPTIONAL, 'Full path where the build is going to be exported to (./country by default)', $this->path)
            ))
            ->setHelp(sprintf(
                '%sBuilds country list files.%s

 Examples:

    #generate all json files for EN locale
    php console cldr json EN

    #generate all xml files for ALL LANGS in /full/path/to/destination/folder folder
    php console cldr xml -p /full/path/to/destination/folder

    #generate all files in ALL FORMATS for ALL LANGS in ./country folder
    php console icu
                ',
                PHP_EOL,
                PHP_EOL
            ));
    }

   /**
    * {@inheritdoc}
    */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->filesystem = new Filesystem();
        $this->filesystem->mkdir($this->path = $input->getOption('path'));

        $verbose = $input->getOption('verbose');
        foreach ($this->importerIterator as $importer) {
            if (null === $input->getArgument('source') || $input->getArgument('source') === $importer->getSource()) {
                $this->filesystem->mkdir($importerDir = $this->path.'/'.$importer->getSource());
                foreach ($importer->getLanguages() as $language) {
                    if (null === $input->getArgument('language') || $input->getArgument('language') === $language) {
                        $this->filesystem->mkdir($exporterDir = $importerDir.'/'.$language);
                        try {
                            $countries = $importer->getCountries($language);
                        } catch (\Zend_Locale_Exception $e) {
                            $countries = null;
                        }
                        if (!is_array($countries)) {
                            $output->writeLn('<info>Country list was not generated for locale ' . $language . '</info>');
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
