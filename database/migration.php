<?php

error_reporting( E_ERROR );

define ('VERSION_MIGRATE','1.0');

/**
 * Class TextBuilder
 */
class TextBuilder
{
    private $text = '';

    /**
     * @param string $text
     * @param int $space
     * @return TextBuilder $this
     */
    public function add($text, $space = 0)
    {
        $k = '';
        if ($space > 0){
            for($space; $space >= 0; $space--){
                $k = $k . ' ';
            }
        }
        $this->text .= $k . $text . PHP_EOL;
        return $this;
    }

    /**
     * @return string
     */
    public function get()
    {
        return $this->text;
    }
}

/**
 * Class Migrate
 */
class Migrate
{
    const FILE_NAME = '.env';

    const DB_HOST = 'DYKYI_MIGRATE_HOST';
    const DB_NAME = 'DYKYI_MIGRATE_NAME';
    const DB_USER = 'DYKYI_MIGRATE_USER';
    const DB_PASS = 'DYKYI_MIGRATE_PASSWORD';

    /**
     * @var TextBuilder $t
     */
    private $t;

    private $inputData = [];

    public function __construct()
    {
        $this->t = new TextBuilder();
    }

    /**
     * @return string
     */
    private function welcomePage()
    {
        return $this->t
            ->add("
   __  __ _____ _____  _____         _______ ______ 
  |  \/  |_   _/ ____||  __ \     /\|__   __|  ____|
  | \  / | | || |  __ | |__) |   /  \  | |  | |__   
  | |\/| | | || | |_ ||  _  /   / /\ \ | |  |  __|  
  | |  | |_| || |__| || | \ \  / ____ \| |  | |____ 
  |_|  |_|_____\_____/|    \_\/_/    \_\_|  |______|")
            ->add('')
            ->add("**************************************************")
            ->add("************ Welcome to migrate ******************")
            ->add("**************************************************")->add('')

            ->add('Usage:')->add("command [options]", 2)->add('')
            ->add('Options:')
                ->add("-a           - Run all", 2)
                ->add("-v           - Display this application version", 2)->add('')

            ->add('Available commands:')
                ->add("connect      - Connect to DB", 2)
                ->add("clear        - Clear DB connect", 2)
                ->add("migrate      - Run migarte", 2)
            ->add('')->add("**************************************************")
            ->get();
    }

    /**
     * Connect to DB
     *
     * @return string
     */
    private function commandConnect()
    {
        $this->InputData("Input DB host: ",     self::DB_HOST);
        $this->InputData("Input DB name: ",     self::DB_NAME);
        $this->InputData("Input DB user: ",     self::DB_USER);
        $this->InputData("Input DB password: ", self::DB_PASS);

        $this->saveInputData(self::FILE_NAME);

        return $this->t->add('Done')->get();
    }

    /**
     * @param $option
     * @return string
     */
    private function commandMigrate($option)
    {
        if (!file_exists(self::FILE_NAME)){
            return $this->t->add('Before run migration function you must run command - "connect"')->get();
        }

        if ($option === '-a'){
            return $this->runAllMigrate();
        }

        if (empty($option)){
            return $this->t->add('Write file names after command "migrate"')->get();
        }

        if (!file_exists($option)){
            return $this->t->add(sprintf('File "%s" not exists!"', $option))->get();
        }

        return $this->runOneMigrate($option);
    }

    /**
     * Clear DB connect
     *
     * @return string
     */
    private function commandClear()
    {
        unset(
            $_SESSION[self::DB_HOST],
            $_SESSION[self::DB_NAME],
            $_SESSION[self::DB_USER],
            $_SESSION[self::DB_PASS]
        );
        unlink(self::FILE_NAME);

        return $this->t->add('Done')->get();
    }

    /**
     * @return string
     */
    private function getVersion()
    {
        return $this->t->add('Version: ' . VERSION_MIGRATE)->get();
    }

    /**
     * @param $text
     * @param $key
     */
    private function inputData($text, $key)
    {
        echo $text;
        $handle = fopen ("php://stdin", "r");
        $line   = fgets($handle);
        $this->inputData[$key] = $line;
    }

    /**
     * @param $fileName
     */
    private function saveInputData($fileName)
    {
        $file = fopen($fileName, "w");
        try {
            fwrite($file, sprintf("%s=%s", self::DB_HOST, $this->inputData[self::DB_HOST]));
            fwrite($file, sprintf("%s=%s", self::DB_NAME, $this->inputData[self::DB_NAME]));
            fwrite($file, sprintf("%s=%s", self::DB_USER, $this->inputData[self::DB_USER]));
            fwrite($file, sprintf("%s=%s", self::DB_PASS, $this->inputData[self::DB_PASS]));
        } finally {
            fclose($file);
        }
    }

    private function getInputData()
    {
        $tmp = [];
        $data = [];
        if (file_exists(self::FILE_NAME)) {

            $f = fopen(self::FILE_NAME, "r");
            while(!feof($f)) {
                $ss = explode('=',str_replace("\n", "", fgets($f)));
                $tmp[] = $ss[1];
            }
            fclose($f);
        }
        foreach ($tmp as $key => $value) {
            $data[] = $value;
        }

        return $data;
    }

    /**
     * @return string
     */
    private function runAllMigrate()
    {
        $config = $this->getInputData();
        try {
            $pdo = new \PDO(sprintf('mysql:host=%s;dbname=%s', $config[0], $config[1]), $config[2], $config[3]);
            $fileList = glob("*.sql");
            foreach ($fileList as $file) {
                $query = file_get_contents($file);
                if (!empty($query)) {
                    $pdo->exec($query);
                }
            }
        } catch (\PDOException $e) {
            return $this->t->add('Error: ' . $e->getMessage())->get();
        }
        return $this->t->add('Done')->get();
    }

    /**
     * @param $fileName
     * @return string
     */
    private function runOneMigrate($fileName)
    {
        $config = $this->getInputData();
        try{
            $pdo = new \PDO(sprintf('mysql:host=%s;dbname=%s', $config[0], $config[1]), $config[2], $config[3]);
            $query = file_get_contents($fileName);
            if (!empty($query)){
                $pdo->exec($query);
            }
        } catch (\PDOException $e) {
            return $this->t->add('Error: ' . $e->getMessage())->get();
        }

        return $this->t->add('Done')->get();
    }

    /**
     * @param string $command
     * @param string $option
     * @return string
     */
    private function execute($command, $option)
    {
        switch ($command){
            case '-v':
                return $this->getVersion();
            case 'connect':
                return $this->commandConnect();
            case 'clear':
                return $this->commandClear();
            case 'migrate':
                return $this->commandMigrate($option);
            default:
                return $this->t->add(sprintf('¯\_(ツ)_/¯ - Command "%s" not found', $command))->get();
        }
    }

    /**
     * @param array $params
     * @return string
     */
    public function run(array $params)
    {
        array_shift($params);
        if (count($params) === 0) {
            return $this->welcomePage();
        }

        list($command, $option) = $params;
        return $this->execute($command, $option);
    }
}

/** Start point */
echo (new Migrate())->run($argv);