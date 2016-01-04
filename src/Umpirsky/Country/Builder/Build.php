<?php

namespace Umpirsky\Country\Builder;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Umpirsky\Country\Exporter\Iterator as ExporterIterator;
use Umpirsky\Country\Importer\Iterator as ImporterIterator;

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
            ->setDescription('Builds list files.')
            ->setDefinition([
                new InputArgument('format', InputArgument::OPTIONAL, 'Format in which to export data, no value means all formats'),
                new InputArgument('language', InputArgument::OPTIONAL, 'Language, no value means all languages'),
            ])
        ;
    }

   /**
    * {@inheritdoc}
    */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->filesystem = new Filesystem();
        $this->filesystem->mkdir($this->path);

        $verbose = $input->getOption('verbose');
        foreach ($this->importerIterator as $importer) {
            $this->filesystem->mkdir($importerDir = $this->path.'/'.$importer->getSource());
            foreach ($importer->getLanguages() as $language) {
                if (null === $input->getArgument('language') || $input->getArgument('language') === $language) {
                    $this->filesystem->mkdir($exporterDir = $importerDir.'/'.$language);
                    $data = $importer->getData($language);

                    foreach ($this->exporterIterator as $exporter) {
                        if (null === $input->getArgument('format') || $input->getArgument('format') === $exporter->getFormat()) {
                            $file = $exporterDir.'/'.$importer->getSource().'.'.$exporter->getFormat();
                            $this->filesystem->touch($file);
                            file_put_contents($file, $exporter->export($data));
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
