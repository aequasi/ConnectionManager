<?php
namespace Aequasi;

use \Symfony\Component\Yaml\Yaml;

use \Exception;

use \Aequasi\ConnectionManager\Connection\Connection;

class ConnectionManager
{

	static public $config = '';

	public static function getConnection( $connectionName, $username, $password )
	{
		$info = self::findConnection( $connectionName );

		/** @var $connectionManager Connection */
		if( isset( $info[ 'class' ] ) ) {
			$connectionManager = new $info[ 'class' ]( );
		} else {
			if( !isset( $info[ 'host' ] ) ) {
				throw new Exception( sprintf( "The %s connection is missing a host", $connectionName ) );
			}
			$connectionManager = new Connection();
			$connectionManager->setHostname( $info[ 'host' ] );
			if( isset( $info[ 'dbname' ] ) ) {
				$connectionManager->setDatabaseName( $info[ 'dbname' ] );
			}
		}

		$connectionManager->setUsername( $username );
		$connectionManager->setPassword( $password );

		return $connectionManager->getConnection();
	}

	public static function findConnection( $connectionName )
	{
		$yaml = Yaml::parse( __DIR__ . '/ConnectionManager/Resources/config/connection.yml' );
		if( !empty( self::$config ) ) {
			$custom = Yaml::parse( $config );
			if( !isset( $custom[ 'connections' ] ) ) {
				throw new Exception( "Custom config file doesn't contain `connections`." );
			}
			$yaml = array_merge_recursive( $yaml, $custom );
		}


		foreach( $yaml[ 'connections' ] as $name => $info ) {
			if( strtolower( $name ) == strtolower( $connectionName ) ) {
				return $info;
			}
		}

		throw new Exception( sprintf( "%s is not a valid connection!", $connectionName ) );
	}
}
