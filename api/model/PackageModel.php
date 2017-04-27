<?php


namespace FindCode\Api\Model;


use Lib\MVC\SubjectInterface;
use Lib\MVC\AbstractSubject;
use RuntimeException;

class PackageModel extends AbstractSubject implements
SubjectInterface,
PackageModelInterface
{
    
    public
        $testable,
        $type,
        $package,
        $description,
        $keywords,
        $license,
        $name,
        $homepage,
        $dependencies,
        $devDependencies,
        $langage,
        $versions,
        $author,
        $distribuable;
        
    
    /**
     * construct PackageModel
     */
    public function __construct()
    {
        parent::__construct();
        $this->distribuable = false;
        $this->testable = false;
        $this->type = "library";
        $this->description = "";
        $this->license = "";
        $this->name = "";
        $this->homepage = "";
        $this->langage = "PHP";
        $this->versions = [];
        $this->dependencies = [];
        $this->devDependencies = [];
        $this->author = "";
        $this->keywords = [];
        $this->package = "";
    }
    
    private function consume ($url, $ping = false)
    {
        $filename= __DIR__ . "/cache/" . md5($url);
       
//         if(file_exists($filename)) {
//             $output = file_get_contents($filename);
//         } else {
            $code = "404";
            $output = @file_get_contents($url);
            if(isset($http_response_header)) {
                $tab = explode(" ", $http_response_header[0]);
                $code = $tab[1];
            } 
            if ($code === "200") {
//                 file_put_contents($filename, $ping ? $url: $output);
            }else { 
                $ping = false;
            }
//         } 
        return $ping ? $ping : json_decode($output);
    }

    private function consumePackage()
    {
        $url = "https://raw.githubusercontent.com/"
             . $this->package
             . "/master/package.json";
        $obj = $this->consume($url);
        if ($obj) {
            $this->setAttribute($obj);
            
        if (isset($obj->dependencies)) {
                $this->dependencies = $obj->dependencies;
            }
            $this->consumeNPM();
            $this->consumeTravis();
            return true;
        }
        return false;
    }
    
    private function consumePackagist()
    {
        $url = "https://packagist.org/packages/"
             . $this->package
             . ".json";
             $obj = $this->consume($url, true);
             if($obj === true)
             {
                 $this->distribuable = true;
        foreach ($obj->package->versions as $key => $value) {
                 $this->version[] = $key;
                 }
             }
    } 
    private function consumeTravis ()
    {
         $url = "https://raw.githubusercontent.com/"
            . $this->package
            . "/master/.travis.yml";
            $obj = $this->consume($url, true);
            if($obj === true)
            {
                $this->testable = true;
               
            }
    }
    
    private function consumeNPM()
    {
             $url = "https://www.npmjs.com/package/" . $this->name;
         $obj = $this->consume($url , true);
         if($obj === true)
         {
             $this->distribuable = true;
         }
    }
    
    private function consumeComposer()
    {
        $url = "https://raw.githubusercontent.com/"
            . $this->package
            . "/master/composer.json";
            $obj = $this->consume($url);
            if ($obj) {
                $this->setAttribute($obj);
                if (isset($obj->require)) {
                      $this->require = $obj->require;
                }
                if (isset($obj->authors)
                   && is_array($obj->authors)
                   && array_key_exists(0, $obj->authors)
                   && isset($obj->authors->name)) {
                       $this->author = $obj->authors->name;
               }
               $this->consumePackagist();
               $this->consumeTravis();
             
                return true;
            }
            return false;
      }
    
    /**
     * 
     * {@inheritDoc}
     * @see \FindCode\Api\Model\PackageModelInterface::get()
     */
    public function get()
    {
      if (!$this->consumePackage()
          && !$this->consumeComposer()) {
          throw new RuntimeException();
          }
  }
   
    public function setAttribute ($obj)
    {
      if (isset($obj->version)) {
          $this->versions= $obj->version;
                    }             
      if (isset($obj->description)) {
          $this->description = $obj->description;
      }
      if (isset($obj->keywords)
          && is_array($obj->keywords))
          {
          $this->keywords = $obj->keywords;
          }
      if (isset($obj->license)) {
          $this->license = $obj->license;
      }
      if (isset($obj->name)) {
          $this->name= $obj->name;
      }   
      if (isset($obj->author)) {
          $this->author= $obj->author;
      }
      if (isset($obj->homepage)) {
          $this->homepage= $obj->homepage;
      } 
      if (isset($obj->langage)) {
          $this->langage= $obj->langage;        
      }
      if (isset($obj->dependencies)) {
          $this->dependencies= $obj->dependencies;
      } 
      if (isset($obj->devDependencies)) {
          $this->devDependencies= $obj->devDependencies;
      }
    }   

}
