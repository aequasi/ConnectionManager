<?php

namespace Aequasi\ConnectionManager\Connection;

use \Doctrine\DBAL\Configuration;
use \Doctrine\DBAL\DriverManager;

use \Exception;

class Connection
{
	/**
	 * @var string
	 */
	protected $hostname;

	/**
	 * @var string
	 */
	protected $databaseName;

	/**
	 * @var string
	 */
	protected $username;

	/**
	 * @var string
	 */
	protected $password;

	/**
	 * @var string
	 */
	protected $driver = 'pdo_mysql';

	/**
	 * @var Configuration
	 */
	protected $configuration;

	public function __construct( Configuration $config = null )
	{
		$this->configuration = isset( $config ) ? $config : new Configuration();
	}

	public function getConnection()
	{
		if ( !isset( $this->hostname ) ) {
			throw new Exception( "Hostname must be set." );
		}

		if ( !isset( $this->username ) ) {
			throw new Exception( "Hostname must be set." );
		}

		if ( !isset( $this->password ) ) {
			throw new Exception( "Hostname must be set." );
		}

		if ( !isset( $this->driver ) ) {
			throw new Exception( "Hostname must be set." );
		}

		$parameters = array(
			'host'     => $this->getHostname(),
			'user'     => $this->getUsername(),
			'password' => $this->getPassword(),
			'driver'   => $this->getDriver()
		);

		if ( isset( $this->databaseName ) ) {
			$parameters[ 'dbname' ] = $this->getDatabaseName();
		}

		return DriverManager::getConnection( $parameters, $this->getConfiguration() );
	}

	public function setDatabaseName( $databaseName )
	{
		$this->databaseName = $databaseName;
	}

	public function getDatabaseName()
	{
		return $this->databaseName;
	}

	public function setDriver( $driver )
	{
		$this->driver = $driver;
	}

	public function getDriver()
	{
		return $this->driver;
	}

	public function setHostname( $hostname )
	{
		$this->hostname = $hostname;
	}

	public function getHostname()
	{
		return $this->hostname;
	}

	public function setPassword( $password )
	{
		$this->password = $password;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setUsername( $username )
	{
		$this->username = $username;
	}

	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * @param Configuration $configuration
	 */
	public function setConfiguration( Configuration $configuration )
	{
		$this->configuration = $configuration;
	}

	/**
	 * @return Configuration
	 */
	public function getConfiguration()
	{
		return $this->configuration;
	}
}
