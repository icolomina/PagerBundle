<?php


/*
 * This file is part of the PagerBundle package.
 *
 * (c) Ignacio Colomina <ignacio.colomina@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MakerLabs\PagerBundle\Adapter;

use MakerLabs\PagerBundle\Adapter\PagerAdapterInterface;

class MongoAdapter implements PagerAdapterInterface \Iterator \Countable{
   
    /**
     * MongoDB cursor
     */
    protected $cursor;
    
    public function __construct(\MongoCursor $cursor){
        
        $this->cursor = $cursor;
    }
    
    public function getTotalResults(){
        
        return $this->cursor->count();
    }
    
    public function getResults($offset, $limit)
    {
        return $this->cursor->sort(array('_id' => -1))->skip($offset)->limit($limit);
    }

    public function isEmpty()
    {
        return $this->cursor->hasNext();
    }
    
    public function current(){
        
        return $this->cursor->current();
    }

    public function key(){
        
        return $this->cursor->key();
    }

    public function next(){
        
        $this->cursor->next();
    }

    public function rewind(){
        
        $this->cursor->rewind();
    }
    
    public function valid(){
        
        return $this->cursor->valid();
    }

    public function count(){
        
        return $this->getTotalResults();
    }
}

?>
