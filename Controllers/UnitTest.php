<?php
/**
 * Controller Unit Test
 * 
 * @author septiadi <septiadi@detik.com>
 */
namespace Controllers;
use Resources;

class UnitTest extends Resources\Controller
{
	public function __construct()
    {
        parent::__construct();	
        $this->app = 'app/';
    }
    
    public function index()
    {
        $this->data = array();
		                
        $Models = $this->listingFile();
        asort($Models);
        //~ echo '<pre>';print_r($Models);echo '</pre>';die();
        
        $this->data['models'] = $Models;
        
        $this->output('UnitTest', $this->data);
    }
    
    private function listingFile($path = '')
    {
        $excludeDir = ['config','Controllers','views'];
        $excludeFile = ['index.php'];
        $subpath = explode('/',$path);
        if(in_array(end($subpath),$excludeDir)){
            return false;
        }
        
        $path = ($path != '')?$path.'/':'';
        $list = scandir($this->app.$path);
        array_shift($list);
        array_shift($list);
        
        $return = [];
        
        foreach ($list as $val)
        {
            
            if(is_dir($this->app.$path.$val)){
                $dump = $this->listingFile($path.$val);
                if($dump)
                $return = array_merge($dump,$return);
            }else{            
                if(!in_array($val,$excludeFile)){                
                    $dump = $path.$val;
                    if($path != '')
                    $return[] = $dump;
                }
            }
        }
        
        
        return $return;
    }
    
    public function test()
    {   
        $path = explode("/",$_GET['f']);
        
        $fileName = array_pop($path);
        
        $className = explode(".",$fileName);
        $className = $className[0];
        
        $path = implode("\\",$path);

        $file = file_get_contents($this->app.str_replace('\\','/',$path)."/".$fileName);
        
        eval("\$this->test = new \\{$path}\\{$className};");
        
        $filearr = explode(PHP_EOL, $file);
        foreach ($filearr as $val)
        {
            preg_match("/\/\*UnitTest:(.*)\|(.*)\|(.*)\*\//", $val, $out);
            if(!empty($out)){
                
                eval("\$func = \$this->test->{$out['1']};");
                
                eval("if(!is_{$out['3']}(\$func)){
                    echo '<font color=\"red\">Function ".addslashes($out['1'])." failed. Expecting {$out['3']} as result</font><br>';
                }else{
                    echo '<font color=\"blue\">Function ".addslashes($out['1'])." passed.</font><br>';
                }");
            }
        }
    }
}

