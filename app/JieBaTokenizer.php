<?php

namespace app;

ini_set('memory_limit', '1024M');
ini_set('max_execution_time', '3600');

use TeamTNT\TNTSearch\Support\AbstractTokenizer;
use TeamTNT\TNTSearch\Support\TokenizerInterface;
use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Finalseg;

class JieBaTokenizer extends AbstractTokenizer implements TokenizerInterface
{

  public function __construct(array $options = [])
  {
    Jieba::init($options);
    if (isset($options['user_dict'])) {
      Jieba::loadUserDict($options['user_dict']);
    }
    Finalseg::init($options);
  }

  public function tokenize($text, $stopwords = [])
  {
    return Jieba::cutForSearch($text);
  }
}
