<?php

	Class MySQLRestore{

		private $_connection;

		public function __construct(MySQL $connection){
			$this->_connection = $connection;
		}

		public function import($data) {
			//$queries = preg_split("/;+(?=([^'|^\\\']*['|\\\'][^'|^\\\']*['|\\\'])*[^'|^\\\']*[^'|^\\\']$)/", $data); // won't work as it's dead slow

			$queries = explode(";\r\n", $data);

			$i = 0;

			foreach ($queries as $query){
				if (strlen(trim($query)) > 0) {
					if (false === $this->_connection->query($query . ";\r\n"))
						return false;
					$i++;
				}
			}
			return $i;
		}
	}
