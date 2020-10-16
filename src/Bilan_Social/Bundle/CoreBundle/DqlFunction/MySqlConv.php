<?php
namespace Bilan_Social\Bundle\CoreBundle\DqlFunction;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MySqlConv
 * Cette classe permet de créer la fonction CONV qui existe sous MySQL afin de l'utiliser dans le langage DQL (Doctrine Query Language)
 */
use Doctrine\ORM\Query\Lexer; 
use Doctrine\ORM\Query\AST\Functions\FunctionNode; 

/** 
 * MysqlConvFunction ::= "CONV(StringPrimary,16,10,4096) = 4096" 
 *      returns CONV(StringPrimary,16,10) & 4096 = 4096
 */ 
class MySqlConv extends FunctionNode
{
    public $stringFirst; 
    public $stringSecond; 
    public $stringThird; 
    public $stringFourth; 

    public function parse(\Doctrine\ORM\Query\Parser $parser) 
    { 
        $parser->match(Lexer::T_IDENTIFIER); 
        $parser->match(Lexer::T_OPEN_PARENTHESIS); 
        $this->stringFourth = $parser->ArithmeticPrimary(); 
        $parser->match(Lexer::T_COMMA);
        $this->stringSecond = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->stringThird = $parser->ArithmeticPrimary();     
        $parser->match(Lexer::T_COMMA);
        $this->stringFirst = $parser->StringPrimary();          
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);          
    } 

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker) 
    { 
        return 'CONV(' . 
            $this->stringFourth->dispatch($sqlWalker). 
        ',' . $this->stringSecond->dispatch($sqlWalker) . ',' . $this->stringThird->dispatch($sqlWalker) . ') & ' . $this->stringFirst->dispatch($sqlWalker); 
    } 
}
