<?php

namespace App\Services;

class BinTreePacking {
	
    public $root;

    public function __construct($w, $h) {
        $this->init($w, $h);
    }

    public function init($w, $h) {        
        $this->root = new Node(0, 0, $w, $h);        
    }

    public function fit($blocks) {

        $blocks = $this->sortMaxside($blocks);

        foreach($blocks as &$block) {

            $block['fit'] = null;

            if($node = $this->findNode($this->root, $block['w'], $block['h'])) {
                $block['fit'] = $this->splitNode($node, $block['w'], $block['h']);
            } 
        }

        return $blocks;        
    }

    public function findNode($node, $w, $h) {
        if($node->used) {
            return $this->findNode($node->right, $w, $h) ?: $this->findNode($node->down, $w, $h);            
        }
        else if($w <= $node->w && $h <= $node->h) {       
            return $node;
        }
        return null;        
    }

    public function splitNode($node, $w, $h) {  
        $node->used  = true;      
        $node->down  = new Node($node->x,      $node->y + $h, $node->w,      $node->h - $h);
        $node->right = new Node($node->x + $w, $node->y,      $node->w - $w, $h);
        return $node;
    }

    public function sortMaxside($blocks) {
        usort($blocks, function($a, $b) {
            $a_maxside = max($a['w'], $a['h']);
            $b_maxside = max($b['w'], $b['h']);
            return $a_maxside < $b_maxside;
        });
        return $blocks;
    }
}

class Node {
    public $x;
    public $y;
    public $w;
    public $h;
    public $used;
    public $right;
    public $down;

    public function __construct($x, $y, $w, $h, $used=false, $right=null, $down=null) {
        $this->x = $x;
        $this->y = $y;
        $this->w = $w;
        $this->h = $h;
        $this->used = $used;
        $this->right = $right;
        $this->down = $down;        
    }
}

