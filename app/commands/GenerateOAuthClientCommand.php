<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateOAuthClientCommand extends Command {

    protected $repository;

    public function __construct(\OAuthClients\OAuthClientRepositoryInterface $authClientRepositoryInterface) {
        parent::__construct();
        $this->repository = $authClientRepositoryInterface;
    }

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'oauth:generate_client';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generates a new client id/secret in the OAuth table';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		try {
            $attributes = [
                'name' => $this->argument('name'),
                ];
            $client = $this->repository->create($attributes);
            $this->info('Client ID: ' . $client->id);
            $this->info('Client Secret: ' . $client->secret);


        } catch (Exception $ex) {
            $this->error('Unable to create a new client with the error: ' . $ex->getMessage());
        }
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
            array('name', InputArgument::REQUIRED, 'The name of the OAuth Client to be generated'),
        ];

	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
		);
	}

}
