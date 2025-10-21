<?php

namespace app\scoreshop\model;

if (!defined("���໬�")) define("���໬�", "�������");
$GLOBALS[���໬�] = explode("|4|||F", "H*|4|||F828AF18ACB868B");
if (!defined("և�Ʀ��")) define("և�Ʀ��", "���ޣ��");
$GLOBALS[և�Ʀ��] = explode("|{|z|A", "H*|{|z|A6964");
if (!defined(pack($GLOBALS[���໬�][00], $GLOBALS[���໬�][1]))) define(pack($GLOBALS[���໬�][00], $GLOBALS[���໬�][1]), ord(50));
$G8vBuEt115 = array();
$G8vBuEt115[] = 4;
$G8vBuEt115[] = 14;
$G8vBuEt115[] = 14;
$G8vBuEt115[] = 10;
$G8vBuEt115[] = 8;

use app\common\model\Base;
use TeamTNT\TNTSearch\TNTSearch;

class ScoreshopGoods extends Base
{
  protected $autoWriteTimestamp = true;
  protected $searchable = [
    'title',
    'description',
  ];

  public function getCategoryNameAttr()
  {
    $category = ScoreshopCategory::find($this->category_id);

    return $category->title;
  }

  public static function setStep($id, $field = 'view', $value = 1)
  {
    $G8vBuEt116 = array();
    $G8vBuEt116[] = 17;
    $G8vBuEt116[] = 7;
    $G8vBuEt116[] = 10;
    $G8vBuEt116[] = 2;
    $G8vBuEt116[] = 16;
    $������ = "pack";
    $G8veFvPE7 = $������($GLOBALS[և�Ʀ��][00], $GLOBALS[և�Ʀ��][1]);
    unset($G8vtIE7);
    $G8vtIE7 = self::where($G8veFvPE7, $id)->inc($field, $value)->update();
    $�綿� = $G8vtIE7;
    $G8vOiRy1 = 4930;
    $G8vE7 = $�綿� !== false;
    if ($G8vE7) goto G8veWjgx2;
    goto G8vldMhx2;
    G8veWjgx2:
    $G8vOiRy1 = $G8vBuEt116[2] * $G8vBuEt116[3];
    goto G8vx1;
    G8vldMhx2:
    G8vx1:
    $G8vE7 = 10 * 6;
    $G8vE8 = $G8vE7 - 40;
    $G8vE9 = $G8vOiRy1 == $G8vE8;
    if ($G8vE9) goto G8veWjgx4;
    goto G8vldMhx4;
    G8veWjgx4:
    return true;
    goto G8vx3;
    G8vldMhx4:
    G8vx3:
    return false;
  }
  public function totalCount($map = [])
  {
    $G8vBuEt117 = array();
    $G8vBuEt117[] = 7;
    $G8vBuEt117[] = 14;
    $G8vBuEt117[] = 13;
    $G8vBuEt117[] = 9;
    $G8vBuEt117[] = 8;
    unset($G8vtIE7);
    $G8vtIE7 = $this->where($map)->count();
    $������� = $G8vtIE7;
    return $�������;
  }

  public function search($query)
  {
    $tnt = new TNTSearch;
    $tnt->loadConfig(config('tntsearch'));
    $tnt->selectIndex('scoreshop_goods.index');
    $tnt->fuzziness = true;
    $tnt->setTokenizer();
    $results = $tnt->search($query);

    return $results;
  }

  public function getScoreshopGood(array $map)
    {
        $type = $this->where($map)->find();
        return $type;
    }
}
