TestApplication "Vacancy"
=======================


Installation
------------

Use commands:

    git clone https://github.com/lwhitel/vacancies-test.git

    composer update

Create database in mysql and add settings in file `config\autoload\local.php`
example code:

    $dbParams = array(
        'database'  => 'vacancy',
        'username'  => 'vacancy123',
        'password'  => 'Vac123ancy!',
        'hostname'  => 'localhost',
        // buffer_results - only for mysqli buffered queries, skip for others
        'options' => array('buffer_results' => true)
    );

    return array(
        'service_manager' => array(
            'factories' => array(
                'Zend\Db\Adapter\Adapter' => function ($sm) use ($dbParams) {
                    $adapter = new BjyProfiler\Db\Adapter\ProfilingAdapter(array(
                        'driver'    => 'pdo',
                        'dsn'       => 'mysql:dbname='.$dbParams['database'].';host='.$dbParams['hostname'],
                        'database'  => $dbParams['database'],
                        'username'  => $dbParams['username'],
                        'password'  => $dbParams['password'],
                        'hostname'  => $dbParams['hostname'],
                    ));

                    if (php_sapi_name() == 'cli') {
                        $logger = new Zend\Log\Logger();
                        // write queries profiling info to stdout in CLI mode
                        $writer = new Zend\Log\Writer\Stream('php://output');
                        $logger->addWriter($writer, Zend\Log\Logger::DEBUG);
                        $adapter->setProfiler(new BjyProfiler\Db\Profiler\LoggingProfiler($logger));
                    } else {
                        $adapter->setProfiler(new BjyProfiler\Db\Profiler\Profiler());
                    }
                    if (isset($dbParams['options']) && is_array($dbParams['options'])) {
                        $options = $dbParams['options'];
                    } else {
                        $options = array();
                    }
                    $adapter->injectProfilingStatementPrototype($options);
                    return $adapter;
                },
            ),
        ),
        'doctrine' => array(
            'connection' => array(
                // Configuration for service `doctrine.connection.orm_default` service
                'orm_default' => array(
                    'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',

                    // connection parameters, see
                    // http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html
                    'params' => array(
                        'host'     => $dbParams['hostname'],
                        'port'     => '3306',
                        'user'     => $dbParams['username'],
                        'password' => $dbParams['password'],
                        'dbname'   => $dbParams['database'],
                    )
                ),
            ),
        ),
    );

next command:

    vendor\bin\doctrine-module orm:schema-tool:update --force

Insert row in table "role":

    INSERT INTO `role` (`id`, `parent_id`, `roleId`) VALUES (1, NULL, 'guest');